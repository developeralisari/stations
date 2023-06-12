<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\UserController;
use App\Models\CspHRJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/ldap_logout', [UserController::class, 'ldap_logout'])->name('ldap_logout');

Route::group(['middleware' => 'web'], function () {
    Route::post('/authenticate', [UserController::class, 'authenticate']);
});

Route::middleware(['ldap_auth_assign'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/guest', [GuestController::class, 'index']);
});

Route::middleware(['ldap_auth'])->group(function () {
    Route::get('/guest', [GuestController::class, 'index']);
});

Route::get('/test', function(){
    $email = "ali.sari@memorial.com.tr";
    $item = CspHRJob::select('*',DB::raw('CONCAT("FIRSTNAME",\' \', "LASTNAME") AS "FULLNAME"'))->whereRaw('"EMAIL" ilike \'%'.$email.'%\'')->first();
    dd($item);
});

Route::post('/query', [HomeController::class, 'index']);
Route::get('/create', [UserController::class, 'create']);

Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['ldap_auth','admin'])->group(function () {
    Route::prefix('admin')->group(function () {

        Route::get('/', [DashboardController::class, 'index']);

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'users']);
            Route::get('add', [UserController::class, 'add']);
            Route::post('add', [UserController::class, 'save']);
            Route::get('edit/{id}', [UserController::class, 'edit']);
            Route::post('edit/{id}', [UserController::class, 'update']);
        });

        Route::prefix('drivers')->group(function () {
            Route::get('/', [DriverController::class, 'index']);
            Route::post('save', [DriverController::class, 'save']);
            Route::post('updateStatus', [DriverController::class, 'updateStatus']);
            Route::post('getUpdateForm', [DriverController::class, 'getUpdateForm']);
            Route::post('update', [DriverController::class, 'update']);
        });

        Route::prefix('cities')->group(function () {
            Route::get('/', [CityController::class, 'index']);
            Route::post('save', [CityController::class, 'save']);
            Route::post('updateStatus', [CityController::class, 'updateStatus']);
            Route::post('getUpdateForm', [CityController::class, 'getUpdateForm']);
            Route::post('update', [CityController::class, 'update']);
            Route::post('getRouteUpdateForm', [CityController::class, 'getRouteUpdateForm']);
            Route::post('updateRoutes', [CityController::class, 'updateRoutes']);
            Route::post('getDistrictUpdateForm', [CityController::class, 'getDistrictUpdateForm']);
            Route::post('getDistrictForm', [CityController::class, 'getDistrictForm']);
            Route::post('updateDistricts', [CityController::class, 'updateDistricts']);

        });

        Route::prefix('branches')->group(function () {
            Route::get('/', [BranchController::class, 'index']);
            Route::post('save', [BranchController::class, 'save']);
            Route::post('saveServiceManager', [BranchController::class, 'saveServiceManager']);
            Route::post('updateStatus', [BranchController::class, 'updateStatus']);
            Route::post('getUpdateForm', [BranchController::class, 'getUpdateForm']);
            Route::post('getUpdateFormServiceManager', [BranchController::class, 'getUpdateFormServiceManager']);
            Route::post('update', [BranchController::class, 'update']);
            Route::post('updateServiceManager', [BranchController::class, 'updateServiceManager']);
        });

        Route::prefix('personels')->group(function () {
            Route::get('/', [PersonelController::class, 'index']);
            Route::post('save', [PersonelController::class, 'save']);
            Route::post('updateStatus', [PersonelController::class, 'updateStatus']);
            Route::post('getUpdateForm', [PersonelController::class, 'getUpdateForm']);
            Route::post('update', [PersonelController::class, 'update']);
        });

        Route::prefix('locations')->group(function () {
            Route::get('/', [LocationController::class, 'index']);
            Route::post('save', [LocationController::class, 'save']);
            Route::post('update', [LocationController::class, 'update']);
            Route::post('getUpdateForm', [LocationController::class, 'getUpdateForm']);
            Route::post('updateStatus', [LocationController::class, 'updateStatus']);
        });
    }); 
});
