<?php

namespace App\Workflows;

use App\Mail\NotifyRequestManager;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class ManagerRequestNotification extends Activity
{
    public function execute()
    {
        //Notify manager of a new request
        $user = User::find(2);
        Mail::to('ryan@dsv.su.se')->send(new NotifyRequestManager($user));
    }
}
