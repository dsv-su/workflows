<?php

namespace App\Workflows;

use App\Models\TravelRequest;
use Finite\State\State;
use Finite\State\StateInterface;
use Finite\StatefulInterface;
use Finite\StateMachine\StateMachine;
use Workflow\ActivityStub;
use Workflow\Models\StoredWorkflow;
use Workflow\SignalMethod;
use Workflow\Workflow;
use Workflow\WorkflowStub;

class TravelRequestWorkflow extends Workflow implements StatefulInterface
{
    private $state;
    private $stateMachine;

    public function setFiniteState($state)
    {
        $this->state = $state;
    }

    public function getFiniteState()
    {
        return $this->state;
    }

    //Signal Submit
    #[SignalMethod]
    public function submit()
    {
        $this->stateMachine->apply('submit');
    }

    //Signal Manager
    #[SignalMethod]
    public function manager_approve()
    {
        $this->stateMachine->apply('managerapprove');
    }

    #[SignalMethod]
    public function manager_return()
    {
        $this->stateMachine->apply('managerreturn');
    }

    #[SignalMethod]
    public function manager_deny()
    {
        $this->stateMachine->apply('managerdeny');
    }

    //Signal FO
    #[SignalMethod]
    public function fo_approve()
    {
        $this->stateMachine->apply('foapprove');
    }

    #[SignalMethod]
    public function fo_return()
    {
        $this->stateMachine->apply('foreturn');
    }

    #[SignalMethod]
    public function fo_deny()
    {
        $this->stateMachine->apply('fodeny');
    }

    //Signal Head
    #[SignalMethod]
    public function head_approve()
    {
        $this->stateMachine->apply('headapprove');
    }

    #[SignalMethod]
    public function head_return()
    {
        $this->stateMachine->apply('headreturn');
    }

    #[SignalMethod]
    public function head_deny()
    {
        $this->stateMachine->apply('headdeny');
    }

    //Wait for statechange
    public function isSubmitted()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'submitted';
    }

    //Manager
    public function ManagerApproved()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'manager_approved';
    }

    public function ManagerReturned()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'manager_returned';
    }

    public function ManagerDenied()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'manager_denied';
    }

    //Finacial officer
    public function FOApproved()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'fo_approved';
    }

    public function FOReturned()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'fo_returned';
    }

    public function FODenied()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'fo_denied';
    }

    //Head
    public function HeadApproved()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'head_approved';
    }

    public function HeadReturned()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'head_returned';
    }

    public function HeadDenied()
    {
        return $this->stateMachine->getCurrentState()->getName() === 'head_denied';
    }

    public function __construct(
        public StoredWorkflow $storedWorkflow, ...$arguments) {
        parent::__construct($storedWorkflow, $arguments);

        $this->stateMachine = new StateMachine();
        //Initial
        $this->stateMachine->addState(new State('created', StateInterface::TYPE_INITIAL));

        //Submitted
        $this->stateMachine->addState('submitted');

        //Manager
        $this->stateMachine->addState('manager_approved');
        $this->stateMachine->addState(new State('manager_denied', StateInterface::TYPE_FINAL));
        $this->stateMachine->addState('manager_returned');

        //FO
        $this->stateMachine->addState('fo_approved');
        $this->stateMachine->addState(new State('fo_denied', StateInterface::TYPE_FINAL));
        $this->stateMachine->addState('fo_returned');

        //Head
        $this->stateMachine->addState('head_approved');
        $this->stateMachine->addState(new State('head_denied', StateInterface::TYPE_FINAL));
        $this->stateMachine->addState('head_returned');

        //Transitions
        $this->stateMachine->addTransition('submit', 'created', 'submitted');

        //Manager
        $this->stateMachine->addTransition('managerapprove', 'submitted', 'manager_approved');
        $this->stateMachine->addTransition('managerreturn', 'submitted', 'manager_returned');
        $this->stateMachine->addTransition('managerdeny', 'submitted', 'manager_denied');

        //FO
        $this->stateMachine->addTransition('foapprove', 'manager_approved', 'fo_approved');
        $this->stateMachine->addTransition('foreturn', 'manager_approved', 'fo_returned');
        $this->stateMachine->addTransition('fodeny', 'manager_approved', 'fo_denied');

        //Head
        $this->stateMachine->addTransition('headapprove', 'fo_approved', 'head_approved');
        $this->stateMachine->addTransition('headreturn', 'fo_approved', 'head_returned');
        $this->stateMachine->addTransition('headdeny', 'fo_approved', 'head_denied');

        //Initialize
        $this->stateMachine->setObject($this);
        $this->stateMachine->initialize();
    }


    public function execute($travelRequest)
    {
        //Submitted by requester
        yield WorkflowStub::await(fn () => $this->isSubmitted());

        //Fire email to manager
        $result = yield ActivityStub::make(ManagerRequestNotification::class);

        //Wait for manager to process request
        yield WorkflowStub::await(fn () => $this->ManagerApproved() || $this->ManagerDenied() || $this->ManagerReturned());

        //Handle managers decision
        switch ($this->stateMachine->getCurrentState()->getName()) {
            case('manager_approved'):
                //Request has been approved ny manager
                //Fire email to FO
                $result = yield ActivityStub::make(FORequestNotification::class);
                break;
            case('manager_returned'):
                //Request had been returned by manager
                //Notify requester
                return 'MReturned: '. $this->stateMachine->getCurrentState()->getName();
                break;
            case('manager_denied'):
                //Request has been denied by manager
                //Notify requester
                return 'MD:' . $this->stateMachine->getCurrentState()->getName();
                break;
        }

        //Wait for financialofficer to process request
        yield WorkflowStub::await(fn () => $this->FOApproved() || $this->FODenied() || $this->FOReturned());

        //Handle FO decision
        switch ($this->stateMachine->getCurrentState()->getName()) {
            case('fo_approved'):
                $result = yield ActivityStub::make(HeadRequestNotification::class);
                break;
            case('fo_returned'):
                //Request had been returned by manager
                return 'FOReturned: '. $this->stateMachine->getCurrentState()->getName();
                break;
            case('fo_denied'):
                //Request should terminate
                return 'FO:' . $this->stateMachine->getCurrentState()->getName();
                break;
        }

        //Wait for Head to process request
        yield WorkflowStub::await(fn () => $this->HeadApproved() || $this->HeadDenied() || $this->HeadReturned());

        //Handle Head decision
        switch ($this->stateMachine->getCurrentState()->getName()) {
            case('head_approved'):
                //Request has been approved
                $result = yield ActivityStub::make(ApprovedRequestNotification::class, $travelRequest);
                break;
            case('head_returned'):
                //Request had been returned by head
                return 'HeadReturned: '. $this->stateMachine->getCurrentState()->getName();
                break;
            case('head_denied'):
                //Request has been denied by head
                return 'Head:' . $this->stateMachine->getCurrentState()->getName();
                break;
        }


        return $this->stateMachine->getCurrentState()->getName();
    }


}
