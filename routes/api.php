<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('regions', [RegionController::class, 'getRegions']);
    Route::get('districts', [RegionController::class, 'getDistricts']);

    Route::get('users', [UserController::class, 'index']);
    Route::post('users/create', [UserController::class, 'create']);

    Route::get('roles', [RoleController::class, 'index']);
});


