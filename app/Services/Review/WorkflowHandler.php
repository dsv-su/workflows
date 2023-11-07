<?php

namespace App\Services\Review;

use Workflow\WorkflowStub;

class WorkflowHandler
{
    protected $workflow;

    public function __construct($id)
    {
        $this->workflow = WorkflowStub::load($id);
    }

    public function ManagerApprove()
    {
        $this->workflow->manager_approve();
    }

    public function FOApprove()
    {
        $this->workflow->fo_approve();
    }

    public function HeadApprove()
    {
        $this->workflow->head_approve();
    }

}
