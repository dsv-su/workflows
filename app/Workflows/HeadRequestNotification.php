<?php

namespace App\Workflows;

use App\Mail\NotifyRequestHead;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class HeadRequestNotification extends Activity
{
    public function execute()
    {
        //Notify FO of a new request
        $user = User::find(2);
        Mail::to('ryan@dsv.su.se')->send(new NotifyRequestHead($user));
    }
}
