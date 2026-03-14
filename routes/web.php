<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');