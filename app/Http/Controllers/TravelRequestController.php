<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Dsvrequest;
use App\Models\TravelRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelRequestController extends Controller
{
    /**
     * Show the TravelRequest form for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(TravelRequest $travelRequest)
    {
        $dsvrequest = Dsvrequest::where('requestid', $travelRequest->id)->first();
        $projectleader = User::find($dsvrequest->projectleader)->name;
        $unithead = User::find($dsvrequest->unithead)->name;

        return view('travel.request', ['request' => $travelRequest, 'dsvrequest' => $dsvrequest, 'projectleader' => $projectleader, 'unithead' => $unithead]);
    }

    public function create()
    {
        $countries = Country::all();
        $projectleaders = User::role('project-leader')->get();
        $unitheads = User::role('unit-head')->get();

        return view('travel.create', ['countries' => $countries, 'projectleaders' => $projectleaders,
            'unitheads' => $unitheads]);
    }

    public function submit(Request $request)
    {
        if ($request->isMethod('post')) {
            //Create a new Travelreqeust
            $travelrequest = TravelRequest::create([
                'created' => 22, //now()->format('Y-m-d')
                'user' => User::find(auth()->user()->id)->email,
                'name' => User::find(auth()->user()->id)->name,
                'purpose' => $request->purpose,
                'project' => $request->project,
                'country' => $request->countryname,
                'paper' =>  $request->paper ?? false,
                'contribution' => $request->contribution,
                'other' => $request->reason,
                'departure' => Carbon::createFromFormat('d/m/Y', $request->departure)->timestamp,
                'return' => Carbon::createFromFormat('d/m/Y', $request->return)->timestamp,
                'days' => $request->days,
                'flight' => $request->flight,
                'hotel' => $request->hotel,
                'daily' => $request->daily,
                'conference' => $request->conference,
                'other_costs' => $request->other_costs,
                'total' => $request->total
            ]);
            //Start a new request
            DsvRequest::create([
                'userid' => User::find(auth()->user()->id)->id,
                'requestid' => $travelrequest->id,
                'type' => 'Travelrequest',
                'projectleader' => (int)$request->project_leader,
                'unithead' => (int)$request->unit_head,
                'pl_status' => 1,
                'uh_status' => 1,
                'status' => 'requested'
            ]);

            return redirect()->route('dashboard');
        }
    }

    public function approve(TravelRequest $travelRequest)
    {
        if(Auth::user()->hasRole('project-leader')) {
            $dsv = Dsvrequest::where('requestid', $travelRequest->id)->first();
            $dsv->pl_status = 2;
            $dsv->status = 'awaiting';
            $dsv->save();
        }
        elseif(Auth::user()->hasRole('unit-head')) {
            $dsv = Dsvrequest::where('requestid', $travelRequest->id)->first();
            $dsv->uh_status = 2;
            $dsv->status = 'approved';
            $dsv->save();
        }
        return redirect()->route('dashboard');
    }

    public function deny(TravelRequest $travelRequest)
    {
        if(Auth::user()->hasRole('project-leader')) {
            $dsv = Dsvrequest::where('requestid', $travelRequest->id)->first();
            $dsv->pl_status = 3;
            $dsv->status = 'denied';
            $dsv->save();
        }
        elseif(Auth::user()->hasRole('unit-head')) {
            $dsv = Dsvrequest::where('requestid', $travelRequest->id)->first();
            $dsv->uh_status = 2;
            $dsv->status = 'denied';
            $dsv->save();
        }
        return redirect()->route('dashboard');
    }


}
