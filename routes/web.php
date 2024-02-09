<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\TestController;
use App\Services\Settings\AuthHandler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

if (class_exists(AuthHandler::class))
    $login = app()->make('SystemService')->authorize()->global->login_route;

//Setting for SU idplogin
Route::get('/sulogin', 'SystemController@SUlogin')->name('sulogin');
Route::get($login, [SystemController::class, 'login'])->name('login');

//Language
Route::get('/lang/{lang}', [LocalizationController::class, 'index'])->name('language');
Route::statamic('search', 'search')->name('search');

//Travelrequest
Route::get('/travel', [\App\Http\Controllers\TravelRequestController::class, 'create'])->name('travel-request-create');
Route::get('/swe/travel', [\App\Http\Controllers\TravelRequestController::class, 'create']);
Route::get('/travel/show/{id}', [\App\Http\Controllers\TravelRequestController::class, 'show'])->name('travel-request-show');
Route::post('/travel', [\App\Http\Controllers\TravelRequestController::class, 'submit'])->name('travel-submit');

//ReviewHandler
Route::get('/travel/review/{id}', [\App\Http\Controllers\ReviewController::class, 'show'])->name('travel-request-review');
Route::post('/review/{id}', [\App\Http\Controllers\ReviewController::class, 'review'])->name('review');
Route::post('/fo_review/{id}', [\App\Http\Controllers\ReviewController::class, 'fo_review'])->name('fo_review');

//FO Handler
Route::get('/list', [\App\Http\Controllers\FOController::class, 'list'])->name('request-list')->middleware('checklang');
Route::get('/swe/list', [\App\Http\Controllers\FOController::class, 'svlist']);

Route::get('/show/{id}', [\App\Http\Controllers\FOController::class, 'show'])->name('fo-request-show');
Route::get('/viewpdf/{id}', [\App\Http\Controllers\FOController::class, 'pdfview'])->name('travel-request-pdfview');
Route::get('/travel/pdf/{id}', [\App\Http\Controllers\FOController::class, 'download'])->name('travel-request-pdf');
Route::get('/settings', [\App\Http\Controllers\FOController::class, 'settings'])->name('settings');
Route::post('/fo', [\App\Http\Controllers\FOController::class, 'settings_fo'])->name('fo');

//Test
Route::get('/test', [TestController::class, 'test'])->name('workflow-dashboard');
Route::get('/truncate', [TestController::class, 'truncate'])->name('truncate');

