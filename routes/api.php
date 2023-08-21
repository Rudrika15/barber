<?php

use App\Http\Controllers\Api\Vendor\PrimaryServicesMasterController;
use App\Http\Controllers\Api\Vendor\SecondaryServicesMasterController;
use App\Http\Controllers\Api\Vendor\UserController;
use App\Http\Controllers\Api\Vendor\VendorController;
use App\Http\Controllers\Api\Vendor\VendorPrimaryServiceController;
use App\Http\Controllers\Api\Vendor\VendorSecondaryServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('vendorregister', [VendorController::class, 'register']);

Route::post('Vendor/login', [VendorController::class, 'authenticate']);
Route::post('register', [UserController::class, 'register']);

Route::get('primary_service_list',[PrimaryServicesMasterController::class,'get_primary_service']);
Route::get('secondary_service_list',[SecondaryServicesMasterController::class,'get_secondary_service']);

Route::get('vendor_secondary_service/{id?}',[VendorSecondaryServiceController::class,'vendor_secondary_service']);
Route::get('vendor_primary_service/{id?}',[VendorPrimaryServiceController::class,'get_vendor_primary_service']);