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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);
if (class_exists(AuthHandler::class))
    $login = app()->make('SystemService')->authorize()->global->login_route;

Route::get($login, [SystemController::class, 'login'])->name('login');
//Language
Route::get('lang/{lang}', [LocalizationController::class, 'index'])->name('language');
Route::statamic('search', 'search')->name('search');
Route::get('/test', [TestController::class, 'test'])->name('test');

