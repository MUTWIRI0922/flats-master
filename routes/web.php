<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UnitImportController;



Route::get('/', function () {
    return view('welcome');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/units/import', [UnitImportController::class, 'create']);
Route::post('/units/import',[UnitImportController::class, 'store']);