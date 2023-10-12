<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocalizationController extends Controller
{
    public function index(Request $request, $locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        session(['localisation' => App::getLocale()]);

        if($locale == 'sv') {
            /*return back()->withInput()->cookie(
                'language', 'se', 0, null, null, false, false
            );*/
            return back();
        }
        return back();
    }
}
