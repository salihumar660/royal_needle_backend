<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\TehsilController;
use App\Http\Controllers\Api\NaapBookController;
//API Routes
Route::apiResource('users', UserController::class);
Route::apiResource('provinces', ProvinceController::class);
Route::apiResource('districts', DistrictController::class);
Route::apiResource('tehsils', TehsilController::class);
Route::apiResource('naapBook', NaapBookController::class);
Route::get('provinces/{provinceId}/districts', [TehsilController::class, 'getDistricts']);
Route::get('districts/{districtId}/tehsils', [TehsilController::class, 'getTehsils']);