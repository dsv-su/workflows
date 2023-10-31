<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use App\Workflows\TravelRequest;
use App\Workflows\TravelRequestWorkflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Statamic\Facades\Role;
use Statamic\Query\Scopes\Filters\UserRole;
use Statamic\Statamic;
use Workflow\Workflow;
use Workflow\WorkflowStub;

class TestController extends Controller
{
    public function test()
   {

   }

   
}
