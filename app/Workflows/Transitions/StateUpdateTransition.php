<?php

namespace App\Workflows\Transitions;

use App\Models\Dashboard;
use Workflow\Activity;

class StateUpdateTransition extends Activity
{
    protected $dashboard, $state;

    public function execute($state, $request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);
        //Transition state
        $this->state = $state;
        $this->dashboard->state = $state;
        $this->dashboard->save();
    }
}
