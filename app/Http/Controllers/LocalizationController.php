<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function index($locale)
    {
        $intended = url()->previous();
        $intended = parse_url($intended);

        if($locale == 'swe') {
            App::setlocale('sv');
            switch ($intended['path']) {
                case('/'):
                    return redirect(url('') . $intended['path'] . $locale);
                default:
                    return redirect(url('') . '/'. $locale . $intended['path']);
            }
        }
        elseif($locale == 'English') {
            App::setlocale('en');
            switch ($intended['path']) {
                case('/swe'):
                    return redirect(url('') );
                default:
                    $intended['path'] = substr($intended['path'], 4);
                    return redirect(url('') . $intended['path']);
            }

        }
        return back();
    }
}
