<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Dashboard;
use App\Models\TravelRequest;
use App\Models\User;
use App\Workflows\TravelRequestWorkflow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Workflow\WorkflowStub;

class TravelRequestController extends Controller
{
    /**
     * Show the TravelRequest form for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        //
    }

    public function create()
    {
        $countries = Country::all();

        //Projectleaders
        $roleIds = DB::table('role_user')->where('role_id', 'project_leader')->pluck('user_id');
        $projectleaders = User::whereIn('id', $roleIds)->get();

        //Unitheads
        $roleIds = DB::table('role_user')->where('role_id', 'unit_head')->pluck('user_id');
        $unitheads = User::whereIn('id', $roleIds)->get();
        return (new \Statamic\View\View)
                   ->template('requests.travel.create')
                   ->layout('mylayout')
                   ->with(['countries' => $countries, 'projectleaders' => $projectleaders,
            'unitheads' => $unitheads]);

    }

    public function submit(Request $request)
    {
        if ($request->isMethod('post')) {
            //dd($request->all());
            //Second validation
            $this->validate($request, [
                'purpose' => 'required',
                'project' => 'required',
                'country' => 'required',
                //'countryname' => 'required',
            ]);

            //Create a new Travelreqeust
            $travelrequest = TravelRequest::create([
                'name' => $request->name,
                'created' => Carbon::createFromFormat('d/m/Y', now()->format('d/m/Y'))->timestamp,
                'state' => 'submitted',
                'user_id' => auth()->user()->id,
                'manager_id' => $request->project_leader,
                'fo_id' => 1, //Testmode - to be changed
                'head_id' => 1, //Testmode - to be changed
                'purpose' => $request->purpose,
                'project' => $request->project,
                'country' => $request->country,
                'paper' =>  $request->paper ?? false,
                'contribution' => $request->contribution,
                'other' => $request->reason,
                'departure' => Carbon::createFromFormat('d/m/Y', $request->start)->timestamp,
                'return' => Carbon::createFromFormat('d/m/Y', $request->end)->timestamp,
                //'days' => $request->days,
                //'flight' => $request->flight,
                //'hotel' => $request->hotel,
                //'daily' => $request->daily,
                //'conference' => $request->conference,
                //'other_costs' => $request->other_costs,
                //'total' => $request->total
                'days' => 1,
                'flight' => 1,
                'hotel' => 1,
                'daily' => 1,
                'conference' => 1,
                'other_costs' => 1,
                'total' => 1
            ]);

            //Create a new Travelreqeust
            $dashboard = Dashboard::create([
                'request_id' => $travelrequest->id,
                'name' => $request->name,
                'created' => Carbon::createFromFormat('d/m/Y', now()->format('d/m/Y'))->timestamp,
                'state' => 'submitted',
                'status' => 'unread',
                'user_id' => auth()->user()->id,
                'manager_id' => $request->project_leader,
                'fo_id' => 1, //Testmode - to be changed
                'head_id' => 1 //Testmode - to be changed
            ]);

            // Create workflow
            /*$workflow = WorkflowStub::make(TravelRequestWorkflow::class);

            // start workflow
            $workflow->start($travelrequest->id);
            $workflow->submit();*/


            return redirect()->route('statamic.site');
        }
    }


}
