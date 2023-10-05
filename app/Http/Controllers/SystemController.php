<?php

namespace App\Http\Controllers;

use App\Services\Settings\ConfigurationHandler;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function login()
    {
        return redirect('/shibboleth-authenticate');
    }

    public function start()
    {
        //Persist system configuration
        $init = new ConfigurationHandler();
        $init->system();
    }
}
