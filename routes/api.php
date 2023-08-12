<?php

use App\Http\Controllers\Api\Vendor\VendorController;
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
Route::get('vendor_list',[VendorController::class,'vendor_list'])->name('vendor_list');
Route::get('single_vendor/{id?}',[VendorController::class,'single_vendor'])->name('single_vendor');
Route::post('register',[VendorController::class,'register'])->name('register');
Route::post('login',[VendorController::class,'login'])->name('login');
Route::post('vendor_edit_Profile/{id?}',[VendorController::class,'vendor_edit_Profile'])->name('vendor_edit_Profile');

