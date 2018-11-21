<?php

Route::prefix('assisted')->group(function () {
    Route::get('/', 'Api\Assisted\AssistedList')->middleware('auth:api');
    Route::get('/{assisted}', 'Api\Assisted\AssistedShow')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-assisted']], function () {
        Route::post('/', 'Api\Assisted\AssistedStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-assisted']], function () {
        Route::put('/{assisted}', 'Api\Assisted\AssistedUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-assisted']], function () {
        Route::delete('/{assisted}', 'Api\Assisted\AssistedDestroy')->middleware('auth:api');
    });
});