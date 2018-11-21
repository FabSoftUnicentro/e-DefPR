<?php

Route::prefix('permission')->group(function () {
    Route::group(['middleware' => ['permission:list-permission']], function () {
        Route::get('/', 'Api\Permission\PermissionList')->middleware('auth:api');
        Route::get('/{permission}', 'Api\Permission\PermissionShow')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:register-permission']], function () {
        Route::post('/', 'Api\Permission\PermissionStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-permission']], function () {
        Route::put('/{permission}', 'Api\Permission\PermissionUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-permission']], function () {
        Route::delete('/{permission}', 'Api\Permission\PermissionDestroy')->middleware('auth:api');
    });
});