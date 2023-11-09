<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class FOController extends Controller
{
    public function list()
    {
        $dashboard = Dashboard::all();
        return (new \Statamic\View\View)
            ->template('requests.fo.list')
            ->layout('mylayout')
            ->with(['dashboards' => $dashboard]);
    }
}
