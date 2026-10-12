<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UnitImportController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpatieController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\user\PropertiesController;



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
    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    Route::get('/admin/payments', [PaymentController::class, 'index'])->name('admin.payments');
    Route::get('/admin/passwordreset', function () {
        return view('admin.passwordreset');
    })->name('admin.passwordreset');
    Route::post('/admin/passwordreset', [AuthController::class, 'resetPassword'])->name('admin.password.reset');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    //admin permissions route
    Route::get('/admin/auth/viewpermissions', [SpatieController::class, 'viewpermissions'])->name('admin.viewpermissions');
    Route::get('/admin/auth/roles', [SpatieController::class, 'viewroles'])->name('admin.viewroles');
    Route::get('/admin/auth/createpermission',function(){
        return view('admin.authorization.createpermissions');
    })->name('admin.createpermission');
    Route::get('/admin/auth/createrole',[SpatieController::class, 'createrole'])->name('admin.createrole');

    Route::post('/admin/auth/storepermission', [SpatieController::class, 'storepermission'])->name('admin.storepermission');
    Route::post('/admin/auth/storerole', [SpatieController::class, 'storerole'])->name('admin.storerole');
    Route::get('/admin/auth/role/{id}', [SpatieController::class, 'viewrole'])->name('admin.viewrole');
    Route::get('/admin/auth/role/{id}/edit', [SpatieController::class, 'editrole'])->name('admin.editrole');
    Route::post('/admin/auth/role/{id}/update', [SpatieController::class, 'updaterole'])->name('admin.updaterole');
    Route::delete('/admin/auth/role/{id}/delete', [SpatieController::class, 'destroyrole'])->name('admin.deleterole');
    Route::get('/admin/reports/usersreports',[DashboardController::class, 'usersreport'])->name('admin.reports.users');
    Route::get('/admin/reports/subscriptionsreports',[DashboardController::class, 'subscriptionsreport'])->name('admin.reports.subscriptions');
    Route::get('/admin/reports/propertiesreports',[DashboardController::class, 'propertiesreport'])->name('admin.reports.properties');



    //user dashboard route
    Route::get('/user/dashboard/', [UserDashboardController::class, 'index'])->name('userdashboard');
    //unit resources routes
    Route::resource('user/properties', PropertiesController::class)->names(
        [
            'index' => 'user.properties',
            'create' => 'user.property.create',
            'store' => 'user.property.store',
            'show' => 'user.property.show',
            'update' => 'user.property.update',
            'edit' => 'user.property.edit',
            'destroy' => 'user.property.destroy'

        ]);
    Route::get('/user/properties/{id}/tenants', [PropertiesController::class, 'property_tenants'])
        ->name('user.property.tenants');
    Route::get('/user/properties/{id}/units', [PropertiesController::class, 'property_units'])
        ->name('user.property.units');
    //unit import routes
    Route::post('/units/add', [UnitController::class, 'store']);
    Route::post('/units/{id}/import',[UnitImportController::class, 'store'])->name('units.import');
    Route::get('/units/importtemplate',[UnitImportController::class, 'template'])->name('units.importtemplate');


    // frontend test routes
    Route::get('/tenants', function () {
        return view('user.tenants');
    })->name('tenants');
    Route::get('/payments', function(){
        return view('user.payments');
    })->name('payments');
    Route::get('/expenses', function(){
        return view('user.expenses');
    })->name('expenses');
    Route::get('/maintenance', function(){
        return view('user.maintenance');
    })->name('maintenance');
    Route::get('/reports', function(){
        return view('user.reports');
    })->name('reports');
    Route::get('/profile', function(){
        return view('user.profile');
    })->name('profile');
    Route::get('/settings', function(){
        return view('user.settings');
    })->name('settings');
    Route::get('/support', function(){
        return view('user.support');
    })->name('support');

    //tenant resources routes
    Route::resource('/{owner_id}/tenants', TenantController::class);
    //lease resources routes
    Route::resource('/{owner_id}/leases', LeaseController::class);

    //subscription routes
    Route::post('/subscription/renew', [SubscriptionController::class, 'renew'])->name('subscription.renew');
    Route::post('/subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.view');
    
});