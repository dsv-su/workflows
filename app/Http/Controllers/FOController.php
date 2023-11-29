<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\TravelRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FOController extends Controller
{
    public function __construct()
    {
        $this->middleware('fo');
    }

    /**
     * Show the TravelRequest form for a given user.
     *
     * @param  int  $id
     * @return \Statamic\View\View
     */
    public function show($id)
    {
        $tr = TravelRequest::find($id);
        $formtype = 'show';

        return (new \Statamic\View\View)
            ->template('requests.travel.show')
            ->layout('mylayout')
            ->with(['tr' => $tr, 'formtype' => $formtype]);
    }

    public function list()
    {
        return (new \Statamic\View\View)
            ->template('requests.fo.list')
            ->layout('mylayout');
    }

    public function pdfview($id)
    {
        $tr = TravelRequest::find($id);
        $user = User::find(Dashboard::where('request_id', $tr->id)->first()->user_id);
        $manager = User::find(Dashboard::where('request_id', $tr->id)->first()->manager_id);
        $head = User::find(Dashboard::where('request_id', $tr->id)->first()->head_id);
        return view('requests.travel.pdf', ['tr' => $tr, 'user' => $user, 'manager' => $manager, 'head' => $head]);
    }

    public function download($id)
    {
        $tr = TravelRequest::find($id);
        $user = User::find(Dashboard::where('request_id', $tr->id)->first()->user_id);
        $manager = User::find(Dashboard::where('request_id', $tr->id)->first()->manager_id);
        $head = User::find(Dashboard::where('request_id', $tr->id)->first()->head_id);
        $pdf = Pdf::loadView('requests.travel.pdf', ['tr' => $tr, 'user' => $user, 'manager' => $manager, 'head' => $head]);
        return $pdf->download('travelrequest_'.$tr->id.'.pdf');
    }
}
