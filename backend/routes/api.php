<?php

use Illuminate\Http\Request;

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

// User routes
Route::prefix('user')->group(function () {
    Route::post('/authenticate', 'Api\UserController@authenticate');
    Route::get('/{id}', 'Api\UserController@show')->middleware('auth:api');
    Route::put('/{id}', 'Api\UserController@update')->middleware('auth:api');
    Route::delete('/{id}', 'Api\UserController@destroy')->middleware('auth:api');
    Route::post('/', 'Api\UserController@store')->middleware('auth:api');
    Route::get('/', 'Api\UserController@index')->middleware('auth:api');
});
