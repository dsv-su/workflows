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
Route::get($login, [SystemController::class, 'login'])->name('login');

//Language
Route::get('lang/{lang}', [LocalizationController::class, 'index'])->name('language');
Route::statamic('search', 'search')->name('search');

//Travelrequest
Route::get('/travel', [\App\Http\Controllers\TravelRequestController::class, 'create'])->name('travel-request-create');
Route::get('/travel/show/{id}', [\App\Http\Controllers\TravelRequestController::class, 'show'])->name('travel-request-show');
Route::post('/travel', [\App\Http\Controllers\TravelRequestController::class, 'submit'])->name('travel-submit');

//ReviewHandler
Route::get('/travel/review/{id}', [\App\Http\Controllers\ReviewController::class, 'show'])->name('travel-request-review');
Route::post('/review/{id}', [\App\Http\Controllers\ReviewController::class, 'review'])->name('review');

//FO Handler
Route::get('/list', [\App\Http\Controllers\FOController::class, 'list'])->name('request-list');

//Test
Route::get('/test', [TestController::class, 'test'])->name('workflow-dashboard');

