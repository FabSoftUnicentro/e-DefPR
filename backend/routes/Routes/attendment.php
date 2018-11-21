<?php

Route::prefix('attendment')->group(function () {
    Route::group(['middleware' => ['permission:list-attendment']], function () {
        Route::get('/', 'Api\AttendmentController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\AttendmentController@show')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:register-attendment']], function () {
        Route::post('/', 'Api\AttendmentController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-attendment']], function () {
        Route::put('/{id}', 'Api\AttendmentController@update')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-attendment']], function () {
        Route::delete('/{id}', 'Api\AttendmentController@destroy')->middleware('auth:api');
    });
});