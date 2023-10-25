<?php

namespace App\Workflows;

use App\Mail\NotifyRequestApproved;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class ApprovedRequestNotification extends Activity
{
    public function execute($travelrequest)
    {
        //Notify Requester - Request has been approved
        $user = User::find(2);
        Mail::to('ryan@dsv.su.se')->send(new NotifyRequestApproved($user));
    }
}
