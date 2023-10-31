<?php

namespace App\Workflows;

use App\Mail\NotifyRequestReturned;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class ReturnedRequestNotification extends Activity
{
    protected $dashboard;

    public function execute($request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);

        //User
        $user = User::find($this->dashboard->user_id);

        //Notify user of returned Request
        $state = $this->dashboard->state;
        switch($state) {
            case('manager_returned'):
                $manager = User::find($this->dashboard->manager_id);
                Mail::to($user->email)->send(new NotifyRequestReturned($user, $manager, $this->dashboard));
                break;
            case('fo_returned'):
                $fo = User::find($this->dashboard->fo_id);
                Mail::to($user->email)->send(new NotifyRequestReturned($user, $fo, $this->dashboard));
                break;
            case('head_returned'):
                $head = User::find($this->dashboard->head_id);
                Mail::to($user->email)->send(new NotifyRequestReturned($user, $head, $this->dashboard));
                break;
        }

    }
}
