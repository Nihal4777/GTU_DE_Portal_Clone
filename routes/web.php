<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Middleware\Authorize;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('registration');
});
Route::post('/register',[AuthController::class,'register']);
Route::get('/admin',function(){
    return view('admin.app');
});

Route::get('/forgot-password', function () {
    return view('reset');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [AuthController::class,'forgot'])->middleware('guest')->name('password.email');;

Route::get('/reset-password/{token}', function (string $token) {
    return view('reset-form', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class,'update_password'])->middleware('guest')->name('password.update');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
     $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed',StudentMiddleware::class])->name('verification.verify');

Route::get('/email/verify', function () {
    // return view('auth.verify-email');
    return "Must Verify Email";
})->middleware('auth')->name('verification.notice');

Route::group(['middleware'=>['auth','verified',StudentMiddleware::class]],function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/profile',[ProfileController::class,'show']);
    Route::post('/profile',[ProfileController::class,'store']);
    Route::resource('team',TeamController::class);
    Route::post('/getDetails',[TeamController::class,'fetch'])->name('team.fetch');
    Route::get('download_certificate',[DocumentsController::class,'cert']);
});


Route::group(['middleware'=>['auth','verified','role:Guide']],function(){
    Route::get('teamRegistrationRequests',[TeamController::class,'requests']);
    Route::post('teamRegistrationAction',[TeamController::class,'action']);
    Route::get('documentApprovals',[DocumentsController::class,'requests']);
    Route::post('documentsAction',[DocumentsController::class,'action']);
});
Route::group(['middleware'=>['auth','verified','role:Student',StudentMiddleware::class]],function(){
    Route::get('tasks',[DocumentsController::class,'timeline']);
    Route::post('uploadCanvas',[DocumentsController::class,'upload'])->name('uploadCanvas');
});


Route::get("/logout",[AuthController::class,'logout']);
Route::get('/login',function(){
    return view('login');
})->name('login');

Route::post('/login',[AuthController::class,'login']);