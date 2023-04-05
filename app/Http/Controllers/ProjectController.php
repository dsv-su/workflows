<?php

namespace App\Http\Controllers;

use App\Imports\ProjectImport;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    public function import()
    {
        Excel::import(new ProjectImport, 'Projektinformation.xlsx');

        return redirect('/')->with('success', 'All good!');
    }

    public function findProject(Request $request)
    {
        $project = Project::search($request->get('query'), null, true)->get();

        return $project;
    }
}
