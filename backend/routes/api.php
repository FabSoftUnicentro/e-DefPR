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
    Route::post('/forgot_password', 'Api\UserController@resetPassword')->middleware('auth:api');
    Route::get('/me', 'Api\UserController@info')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-employee']], function () {
        Route::post('/', 'Api\UserController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-employee']], function () {
        Route::put('/{id}', 'Api\UserController@update')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:read-employee']], function () {
        Route::get('/{id}', 'Api\UserController@show')->middleware('auth:api');
        Route::get('/', 'Api\UserController@index')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-employee']], function () {
        Route::delete('/{id}', 'Api\UserController@destroy')->middleware('auth:api');
    });
});

// State routes
Route::prefix('state')->group(function () {
    Route::get('/', 'Api\StateController@index')->middleware('auth:api');
    Route::get('/{id}', 'Api\StateController@show')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-state']], function () {
        Route::post('/', 'Api\StateController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-state']], function () {
        Route::put('/{id}', 'Api\StateController@update')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-state']], function () {
        Route::delete('/{id}', 'Api\StateController@destroy')->middleware('auth:api');
    });
});

// City routes
Route::prefix('city')->group(function () {
    Route::get('/', 'Api\CityController@index')->middleware('auth:api');
    Route::get('/{id}', 'Api\CityController@show')->middleware('auth:api');
    Route::get('/state/{id}', 'Api\CityController@findByState')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-city']], function () {
        Route::post('/', 'Api\CityController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-city']], function () {
        Route::put('/{id}', 'Api\CityController@update')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-city']], function () {
        Route::delete('/{id}', 'Api\CityController@destroy')->middleware('auth:api');
    });
});

// Assisted route
Route::prefix('assisted')->group(function () {
    Route::get('/', 'Api\AssistedController@index')->middleware('auth:api');
    Route::get('/{id}', 'Api\AssistedController@show')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-assisted']], function () {
        Route::post('/', 'Api\AssistedController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-assisted']], function () {
        Route::put('/{id}', 'Api\AssistedController@update')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-assisted']], function () {
        Route::delete('/{id}', 'Api\AssistedController@destroy')->middleware('auth:api');
    });
});
