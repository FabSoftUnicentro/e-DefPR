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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::post('authenticate', 'Api\UserController@authenticate');
    Route::get('/{id}', 'Api\UserController@show');
    Route::put('/{id}', 'Api\UserController@update');
    Route::delete('/{id}', 'Api\UserController@destroy');
    Route::post('/', 'Api\UserController@store');
    Route::get('/', 'Api\UserController@index');
});
