<?php

use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/client', 'ClientController');
    Route::apiResource('/sample', 'AccessSampleController');
    Route::apiResource('/type', 'AccessTypeController');
    Route::apiResource('/client/{client}/access', 'AccessController');
    Route::get('/client/{client}/access/{id}/compil', 'AccessController@compil');
});