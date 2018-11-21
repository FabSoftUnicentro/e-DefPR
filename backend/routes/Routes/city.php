<?php

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