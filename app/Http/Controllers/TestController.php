<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Statamic\Statamic;

class TestController extends Controller
{
   public function test()
   {
       return (new \Statamic\View\View)
           ->template('workflow.dashboard')
           ->layout('mylayout')
           ->with(['title' => 'Example Title']);
   }
}
