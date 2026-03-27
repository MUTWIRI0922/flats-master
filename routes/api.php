<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\TenantController;

Route::get('/users', [AuthController::class, 'index']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::resource('/{owner_id}/tenants', TenantController::class);
Route::resource('/{property_id}/units', UnitController::class);
Route::resource('/{owner_id}/properties', PropertyController::class);