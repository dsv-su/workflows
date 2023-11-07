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

    public function approve($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->manager_approve();
        return $workflow->output();
    }

    public function foapprove($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->fo_approve();
        return $workflow->output();
    }

    public function headapprove($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->head_approve();
        return $workflow->output();
    }

    public function return($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->manager_return();
        return $workflow->output();
    }

    public function foreturn($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->fo_return();
        return $workflow->output();
    }

    public function headreturn($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->head_return();
        return $workflow->output();
    }

    public function deny($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->manager_deny();
        return $workflow->output();
    }

    public function fodeny($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->fo_deny();
        return $workflow->output();
    }

    public function headdeny($id)
    {
        $workflow = WorkflowStub::load($id);
        $workflow->head_deny();
        return $workflow->output();
    }

    public function truncate_workflows()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('failed_jobs')->truncate();
        DB::table('workflow_exceptions')->truncate();
        DB::table('workflow_logs')->truncate();
        DB::table('workflow_relationships')->truncate();
        DB::table('workflow_signals')->truncate();
        DB::table('workflow_timers')->truncate();
        DB::table('workflows')->truncate();
        DB::table('travel_requests')->truncate();
        DB::table('dashboards')->truncate();
        DB::table('manager_comments')->truncate();
        DB::table('fo_comments')->truncate();
        DB::table('head_comments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return ('Done');
    }
}
