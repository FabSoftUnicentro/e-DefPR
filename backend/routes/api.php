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
    Route::get('/me', 'Api\UserController@info')->middleware('auth:api');
    Route::get('/{id}', 'Api\UserController@show')->middleware('auth:api');
    Route::put('/{id}', 'Api\UserController@update')->middleware('auth:api');
    Route::delete('/{id}', 'Api\UserController@destroy')->middleware('auth:api');
    Route::post('/', 'Api\UserController@store')->middleware('auth:api');
    Route::get('/', 'Api\UserController@index')->middleware('auth:api');
});

// State routes
Route::prefix('state')->group(function () {
    Route::get('/{id}', 'Api\StateController@show')->middleware('auth:api');
    Route::put('/{id}', 'Api\StateController@update')->middleware('auth:api');
    Route::delete('/{id}', 'Api\StateController@destroy')->middleware('auth:api');
    Route::post('/', 'Api\StateController@store')->middleware('auth:api');
    Route::get('/', 'Api\StateController@index')->middleware('auth:api');
});

// Postcode route
Route::prefix('postcode')->group(function () {
    Route::get('/{id}', 'Api\PostcodeController@find');
});
