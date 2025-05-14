<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IotDataController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('auth.login');
    
});Route::get('/dashboard', function () {
    return view('dashboard');});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');  
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('tabel-pakan', [IotDataController::class, 'index'])->name('tabel.pakan');