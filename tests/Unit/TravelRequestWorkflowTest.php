<?php

namespace Tests\Unit;

use App\Models\Dashboard;
use App\Models\TravelRequest;
use App\Workflows\DSVRequestWorkflow;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Workflow\WorkflowStub;

class TravelRequestWorkflowTest extends TestCase
{
    public function testInitialStateIsCreated()
    {
        //Create a new Travelreqeust
        $travelrequest = TravelRequest::create([
            'name' => 'TestCase',
            'created' => Carbon::createFromFormat('d/m/Y', now()->format('d/m/Y'))->timestamp,
            'state' => 'submitted',
            'purpose' => 'Test',
            'project' => 1000,
            'country' => 'Norway',
            'paper' =>  false,
            'contribution' => 'No',
            'other' => 'No',
            'departure' => Carbon::createFromFormat('d/m/Y', 20231220)->timestamp,
            'return' => Carbon::createFromFormat('d/m/Y', 20231230)->timestamp,
            'days' => 10,
            'flight' => 1000,
            'hotel' => 2000,
            'daily' => 500,
            'conference' => 3000,
            'other_costs' => 4000,
            'total' => 10000,

        ]);

        //Create a new Dashboard post
        $dashboard = Dashboard::create([
            'request_id' => $travelrequest->id,
            'name' => 'TestCase',
            'created' => Carbon::createFromFormat('d/m/Y', now()->format('d/m/Y'))->timestamp,
            'state' => 'submitted',
            'status' => 'unread',
            'type' => 'travelrequest',
            'user_id' => 8,
            'manager_id' => 2,
            'fo_id' => 2,
            'head_id' => 2
        ]);
        $workflow = WorkflowStub::make(DSVRequestWorkflow::class);
        $workflow->start($dashboard->id);
        $workflow->submit();
        $this->assertEquals('created', $workflow->getFiniteState());
    }

    public function testSubmitTransition()
    {
        $workflow = new DSVRequestWorkflow(/* Provide necessary dependencies */);
        $workflow->submit();

        $this->assertEquals('submitted', $workflow->getFiniteState());
    }

    // Add more tests for other state transitions and methods as needed
}
