<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitImportController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\SubscriptionController;



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
    //unit resources routes
    Route::resource('/{property_id}/units', UnitController::class);
    //property resources routes
    Route::resource('/{owner_id}/properties', PropertyController::class);
    //tenant resources routes
    Route::resource('/{owner_id}/tenants', TenantController::class);
    //lease resources routes
    Route::resource('/{owner_id}/leases', LeaseController::class);
    //unit import routes
    Route::get('/units/import', [UnitImportController::class, 'create']);
    Route::post('/units/import',[UnitImportController::class, 'store']);
    //subscription routes
    Route::post('/subscription/renew', [SubscriptionController::class, 'renew'])->name('subscription.renew');
    Route::post('/subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.view');
    
});