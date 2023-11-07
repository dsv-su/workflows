<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\TravelRequest;
use App\Services\Review\RequestReviewHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function review(Request $request, $req)
    {
        //Check request type
        $dashboard = Dashboard::find($req);

        // Retrieve the currently authenticated user's ID
        $user = Auth::user();

        $handler = new RequestReviewHandler($dashboard, $user, $request->comment);
        $handler->review();


        return redirect('/')->with('status', 'Request approved');
    }

}
