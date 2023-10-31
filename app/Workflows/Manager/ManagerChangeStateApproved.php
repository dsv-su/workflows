<?php

namespace App\Workflows\Manager;

use App\Models\Dashboard;
use Workflow\Activity;

class ManagerChangeStateApproved extends Activity
{
    protected $dashboard;

    public function execute($request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);
        //Transition state
        $this->dashboard->state = 'manager_approved';
        $this->dashboard->save();
    }
}
