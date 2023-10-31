<?php

namespace App\Workflows\Manager;

use App\Mail\NotifyRequestManager;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class ManagerRequestNotification extends Activity
{
    protected $dashboard;

    public function execute($request)
    {
        //Retrive request dashboard
        $id = $request[0];
        $this->dashboard = Dashboard::find($id);

        //Notify manager of a new request
        $user = User::find($this->dashboard->user_id);
        $manager = User::find($this->dashboard->manager_id);
        Mail::to($manager->email)->send(new NotifyRequestManager($user, $this->dashboard));
    }
}
