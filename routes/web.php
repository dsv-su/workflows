<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    \the42coders\Workflows\Workflows::routes();
});
//Login
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Travelrequest
Route::get('/travel', [\App\Http\Controllers\TravelRequestController::class, 'create'])->name('travel-request-create');
Route::get('/travel/{travelRequest}', [\App\Http\Controllers\TravelRequestController::class, 'show'])->name('travel-request');
Route::post('/travel', [\App\Http\Controllers\TravelRequestController::class, 'submit'])->name('travel-submit');
Route::get('/travel/approved/{travelRequest}', [\App\Http\Controllers\TravelRequestController::class, 'approve'])->name('travel-approve');
Route::get('/travel/denied/{travelRequest}', [\App\Http\Controllers\TravelRequestController::class, 'deny'])->name('travel-deny');

//Search
Route::get('/findproject', [\App\Http\Controllers\ProjectController::class, 'findProject']);

//Import
Route::get('/import', [\App\Http\Controllers\ProjectController::class, 'import'])->name('import-projects');
//External
Route::get('/car', [\App\Http\Controllers\ExternalRequestController::class, 'create'])->name('car-request-create');
