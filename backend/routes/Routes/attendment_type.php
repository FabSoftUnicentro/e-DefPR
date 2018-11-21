<?php

Route::prefix('attendment-type')->group(function () {
    Route::group(['middleware' => ['permission:list-attendmentType']], function () {
        Route::get('/', 'Api\AttendmentTypeController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\AttendmentTypeController@show')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:register-attendmentType']], function () {
        Route::post('/', 'Api\AttendmentTypeController@store')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:update-attendmentType']], function () {
        Route::put('/{id}', 'Api\AttendmentTypeController@update')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:delete-attendmentType']], function () {
        Route::delete('/{id}', 'Api\AttendmentTypeController@destroy')->middleware('auth:api');
    });
});