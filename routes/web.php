<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', [HomeController::class,'index']);

Route::group(['middleware' => 'authed'], function () {
    Route::get('/team', [TeamController::class, 'index']);
});



Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/admindashboard/createSlug', [AdminDashboardController::class,'createSlug'])->middleware('isadmin');
Route::resource('admindashboard', AdminDashboardController::class)->middleware('isadmin');

// Route::get('/upload/createSlug', [HomeController::class,'createSlug']);
// Route::get('/upload', [HomeController::class,'create'])->middleware('isadmin');
// Route::post('/upload', [HomeController::class,'store']);
// Route::delete('/upload',[HomeController::class,'destroy']);

Route::get('/{post:slug}', [HomeController::class,'show']);