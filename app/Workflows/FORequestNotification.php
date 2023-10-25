<?php

namespace App\Workflows;

use App\Mail\NotifyRequestFO;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class FORequestNotification extends Activity
{
    public function execute()
    {
        //Notify FO of a new request
        $user = User::find(2);
        Mail::to('ryan@dsv.su.se')->send(new NotifyRequestFO($user));
    }
}
