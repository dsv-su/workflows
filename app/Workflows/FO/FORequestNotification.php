<?php

namespace App\Workflows\FO;

use App\Mail\NotifyRequestFO;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class FORequestNotification extends Activity
{
    protected $dashboard;

    public function execute($request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);

        //Notify FO of a new request
        $user = User::find($this->dashboard->user_id);
        $manager = User::find($this->dashboard->manager_id);
        $fo = User::find($this->dashboard->fo_id);
        Mail::to($fo->email)->send(new NotifyRequestFO($user, $manager, $this->dashboard));
    }
}
