<?php

namespace App\Workflows;

use App\Mail\NewUser;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Workflow\Activity;

class TestActivity extends Activity
{
    public function execute()
    {
        $user = User::find(2);
        Mail::to('ryan@dsv.su.se')->send(new NewUser($user));
        //return $result;
    }
}
