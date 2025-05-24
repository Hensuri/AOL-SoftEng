<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


Route::get('/', [HomeController::class,'index']);

Route::group(['middleware' => 'authed'], function () {
    Route::get('/team', [TeamController::class, 'index']);
});



Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/upload/createSlug', [HomeController::class,'createSlug']);
Route::get('/upload', [HomeController::class,'create'])->middleware('isadmin');
Route::post('/upload', [HomeController::class,'store']);

Route::get('/{post:slug}', [HomeController::class,'show']);