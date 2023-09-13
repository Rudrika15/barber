<?php

// use App\Http\Controllers\Api\Vendor\PrimaryServicesMasterController;
// use App\Http\Controllers\Api\Vendor\SecondaryServicesMasterController;
// use App\Http\Controllers\Api\Vendor\UserController;
// use App\Http\Controllers\Api\Vendor\VendorController;
// use App\Http\Controllers\Api\Vendor\VendorPrimaryServiceController;
// use App\Http\Controllers\Api\Vendor\VendorScheduleController;
// use App\Http\Controllers\Api\Vendor\VendorSecondaryServiceController;

use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Admin\PrimaryServicesMasterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/home',[HomeController::class,'index']);

Route::post('/view',[HomeController::class,'view']);
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/getUserProfile', [AuthController::class, 'getUserProfile']); 

Route::post('/adminlogin',[AdminController::class,'login']);
Route::get('/get_primary_service',[PrimaryServicesMasterController::class,'get_primary_service']);
Route::post('/store_primary_service',[PrimaryServicesMasterController::class,'store_primary_service']);
Route::post('/update_primary_service/{id}',[PrimaryServicesMasterController::class,'update_primary_service']);
Route::get('/delete_primary_service/{id}',[PrimaryServicesMasterController::class,'delete_primary_service']);

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// // Route::post('vendorregister', [VendorController::class, 'register']);

// Route::post('Vendor/login', [VendorController::class, 'authenticate']);
// Route::post('register', [UserController::class, 'register']);

// Route::get('vendor_details/{id?}',[VendorController::class,'vendor_details']);
// Route::get('primary_service_list',[PrimaryServicesMasterController::class,'get_primary_service']);
// Route::get('secondary_service_list',[SecondaryServicesMasterController::class,'get_secondary_service']);

// Route::get('vendor_service/{id?}',[VendorSecondaryServiceController::class,'vendor_secondary_service']);
// Route::get('vendor_primary_service/{id?}',[VendorPrimaryServiceController::class,'get_vendor_primary_service']);

// Route::post('vendor_create_schedule',[VendorScheduleController::class,'vendor_create_schedule']);
// Route::get('vendor_schudule_list/{id?}',[VendorScheduleController::class,'vendor_schudule_list']);