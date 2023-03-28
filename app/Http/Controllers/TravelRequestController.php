<?php

namespace App\Http\Controllers;

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
        return view('travel.request', ['travel' => $travelRequest]);
    }

    public function create()
    {
        return view('travel.create');
    }

    public function submit(Request $request)
    {
        if ($request->isMethod('post')) {
            //dd($request->all());
            TravelRequest::create([
                'created' => 22, //now()->format('Y-m-d')
                'user' => User::find(auth()->user()->id)->email,
                'purpose' => $request->purpose,
                'paper' =>  $request->paper ?? false,
                'contribution' => $request->contribution,
                'other' => $request->other,
                'departure' => Carbon::createFromFormat('d/m/Y', $request->departure)->timestamp,
                'return' => Carbon::createFromFormat('d/m/Y', $request->return)->timestamp,
                'total' => $request->total, //$request->total,
                'project' => $request->project,
                'status' => 'requested',
                'approved' => 0
            ]);
            return redirect()->route('dashboard');
        }
    }

    public function approve(TravelRequest $travelRequest)
    {
        if(Auth::user()->hasRole('project-leader')) {
            $travelRequest->approved = 1;
            $travelRequest->status = 'Awaiting';
            $travelRequest->save();
        }
        elseif(Auth::user()->hasRole('unit-head')) {
            $travelRequest->approved = 2;
            $travelRequest->status = 'Approved';
            $travelRequest->save();
        }
        return redirect()->route('dashboard');
    }

    public function deny(TravelRequest $travelRequest)
    {
        if(Auth::user()->hasRole('project-leader')) {
            $travelRequest->approved = 3;
            $travelRequest->status = 'Denied';
            $travelRequest->save();
        }
        elseif(Auth::user()->hasRole('unit-head')) {
            $travelRequest->approved = 3;
            $travelRequest->status = 'Denied';
            $travelRequest->save();
        }
        return redirect()->route('dashboard');
    }

}
