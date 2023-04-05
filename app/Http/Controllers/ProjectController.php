<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\Skatteverket;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function findProject(Request $request)
    {
        $project = Project::search($request->get('query'), null, true)->get();

        return $project;
    }

    public function getCountry()
    {
        $skatteverket = new Skatteverket();
        $skatteverket->getCountry();
    }
}
