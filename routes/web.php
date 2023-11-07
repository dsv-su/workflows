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
Route::get('/travel/review/{id}', [\App\Http\Controllers\TravelRequestController::class, 'review'])->name('travel-request-review');
Route::get('/travel/show/{id}', [\App\Http\Controllers\TravelRequestController::class, 'show'])->name('travel-request-show');
Route::post('/travel', [\App\Http\Controllers\TravelRequestController::class, 'submit'])->name('travel-submit');

//ReviewHandler
Route::post('/review/{id}', [\App\Http\Controllers\ReviewController::class, 'review'])->name('review');

//Workflow
Route::get('/test', [TestController::class, 'test'])->name('workflow-dashboard');
Route::get('/submit/{id}', [TestController::class, 'submit']);
Route::get('/approve/{id}', [TestController::class, 'approve']);
Route::get('/foapprove/{id}', [TestController::class, 'foapprove']);
Route::get('/headapprove/{id}', [TestController::class, 'headapprove']);
Route::get('/deny/{id}', [TestController::class, 'deny']);
Route::get('/fodeny/{id}', [TestController::class, 'fodeny']);
Route::get('/headdeny/{id}', [TestController::class, 'headdeny']);
Route::get('/return/{id}', [TestController::class, 'return']);
Route::get('/foreturn/{id}', [TestController::class, 'foreturn']);
Route::get('/headreturn/{id}', [TestController::class, 'headreturn']);
Route::get('/truncate', [TestController::class, 'truncate_workflows']);

