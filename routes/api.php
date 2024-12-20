<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProtocolController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ViolatorTypeController;
use App\Http\Controllers\Api\ViolationController;
use App\Http\Controllers\Api\RepressionController;
use App\Http\Controllers\Api\InformationController;

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
Route::post('auth-login', [LoginController::class, 'auth']);
Route::post('send-sms', [UserController::class, 'sendSms']);

Route::get('info', function (){
    return \App\Models\BuildingType::query()->select(['id', 'name'])->get();
});


Route::group(['middleware' => ['auth:api']], function() {

    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('regions', [RegionController::class, 'getRegions']);
    Route::get('districts', [RegionController::class, 'getDistricts']);


    Route::get('users', [UserController::class, 'index']);
    Route::post('users/create', [UserController::class, 'create']);
    Route::post('users/delete', [UserController::class, 'delete']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('pinfl', [UserController::class, 'getUserData']);

    Route::get('well-status', [InformationController::class, 'getWellStatus']);
    Route::get('counter-info', [InformationController::class, 'getCounterInfo']);
    Route::get('protocol-type', [InformationController::class, 'getProtocolType']);
    Route::get('smz', [InformationController::class, 'getSMZ']);
    Route::get('debit', [InformationController::class, 'getDebit']);
    Route::get('organizations', [InformationController::class, 'getOrganizations']);
    Route::get('measures', [InformationController::class, 'getMeasures']);
    Route::get('standard-norms', [InformationController::class, 'getStandardNorms']);
    Route::get('consumer', [InformationController::class, 'getConsumer']);
    Route::get('building-types', [InformationController::class, 'getBuildingTypes']);


    Route::get('roles', [RoleController::class, 'index']);

    Route::get('violator-types', [ViolatorTypeController::class, 'index']);

    Route::get('violations', [ViolationController::class, 'index']);

    Route::get('repressions', [RepressionController::class, 'index']);

    Route::get('protocols', [ProtocolController::class, 'index']);
    Route::get('protocol/logs', [ProtocolController::class, 'logs']);

    Route::post('protocols/create', [ProtocolController::class, 'create']);

    Route::post('protocols/edit', [ProtocolController::class, 'edit']);

    Route::post('protocols/reject', [ProtocolController::class, 'reject']);

    Route::post('protocols/confirm', [ProtocolController::class, 'confirm']);
});


