<?php

namespace App\Workflows\Transitions;

use App\Models\Dashboard;
use App\Models\TravelRequest;
use Workflow\Activity;

class StateUpdateTransition extends Activity
{
    protected $dashboard, $state, $req;

    public function execute($state, $request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);
        //Transition state
        $this->state = $state;
        $this->dashboard->state = $state;
        $this->dashboard->save();

        //Transition state to request origin
        switch($this->dashboard->type) {
            //Travel request
            case('travelrequest'):
                $this->req = TravelRequest::find($this->dashboard->request_id);
                $this->req->state = $this->state;
                $this->req->save();
                break;
        }
    }
}
