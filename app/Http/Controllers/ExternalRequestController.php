<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExternalRequestController extends Controller
{

    public function create()
    {
        return view('external.car');
    }
}
