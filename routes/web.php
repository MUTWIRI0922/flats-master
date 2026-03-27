<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitImportController;
use App\Http\Controllers\TenantController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth')->group(function () {
    Route::resource('/{property_id}/units', UnitController::class);
    Route::resource('/{owner_id}/properties', PropertyController::class);
    Route::resource('/{owner_id}/tenants', TenantController::class);
    Route::get('/units/import', [UnitImportController::class, 'create']);
    Route::post('/units/import',[UnitImportController::class, 'store']);

});