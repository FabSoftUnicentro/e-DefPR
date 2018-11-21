<?php

Route::prefix('state')->group(function () {
    Route::get('/', 'Api\State\StateList')->middleware('auth:api');
    Route::get('/{state}', 'Api\State\StateShow')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-state']], function () {
        Route::post('/', 'Api\State\StateStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-state']], function () {
        Route::put('/{state}', 'Api\State\StateUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-state']], function () {
        Route::delete('/{state}', 'Api\State\StateDestroy')->middleware('auth:api');
    });
});