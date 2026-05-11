<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitImportController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpatieController;



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
    //admin dashboard route
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AuthController::class, 'index'])->name('admin.users');
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.view');
    Route::get('/admin/properties', [PropertyController::class, 'allproperties'])->name('properties.view');
    Route::get('/admin/profileview', [AuthController::class, 'adminprofileview'])->name('admin.profileview');
    Route::get('/admin/profileedit', [AuthController::class, 'adminprofileedit'])->name('admin.profileedit');
    Route::put('/admin/{id}/profileupdate', [AuthController::class, 'update'])->name('admin.profileupdate');
    //admin permissions route
    Route::get('/admin/auth/viewpermissions', [SpatieController::class, 'viewpermissions'])->name('admin.viewpermissions');
    Route::get('/admin/auth/roles', [SpatieController::class, 'viewroles'])->name('admin.viewroles');
    Route::get('/admin/auth/createpermission',function(){
        return view('admin.authorization.createpermissions');
    })->name('admin.createpermission');
    Route::get('/admin/auth/createrole',[SpatieController::class, 'createrole'])->name('admin.createrole');

    Route::post('/admin/auth/storepermission', [SpatieController::class, 'storepermission'])->name('admin.storepermission');
    Route::post('/admin/auth/storerole', [SpatieController::class, 'storerole'])->name('admin.storerole');
    //user dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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