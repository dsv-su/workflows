<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        return view('travel.request');
    }
}
