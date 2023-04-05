<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function findProject(Request $request)
    {
        $project = Project::search($request->get('query'), null, true)->get();

        return $project;
    }
}
