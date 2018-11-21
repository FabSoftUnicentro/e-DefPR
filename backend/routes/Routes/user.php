<?php

Route::prefix('user')->group(function () {
    Route::post('/authenticate', 'Api\User\UserAuthenticate');
    Route::post('/forgot-password', 'Api\User\UserForgotPassword');
    Route::get('/logout', 'Api\User\UserLogout')->middleware('auth:api');
    Route::get('/me', 'Api\User\UserInfo')->middleware('auth:api');
    Route::get('/{user}/permissions', 'Api\User\UserAllPermissions')->middleware('auth:api');
    Route::put('/reset-password', 'Api\User\UserResetPassword')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-employee']], function () {
        Route::post('/', 'Api\User\UserStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:assign-user-permission']], function () {
        Route::put('/{user}/assign-permission/{permission}', 'Api\User\UserAssignPermission')->middleware('auth:api');
        Route::put('/{user}/assign-permissions', 'Api\User\UserAssignPermissions')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:unassign-user-permission']], function () {
        Route::put('/{user}/unassign-permission/{permission}', 'Api\User\UserUnassignPermission')->middleware('auth:api');
        Route::put('/{user}/unassign-permissions', 'Api\User\UserUnassignPermissions')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:assign-user-role']], function () {
        Route::put('/{user}/assign-role/{role}', 'Api\User\UserAssignRole')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:unassign-user-role']], function () {
        Route::put('/{user}/unassign-role/{role}', 'Api\User\UserUnassignRole')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-employee']], function () {
        Route::put('/{user}', 'Api\User\UserUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:read-employee']], function () {
        Route::get('/{user}', 'Api\User\UserShow')->middleware('auth:api');
        Route::get('/', 'Api\User\UserList')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-employee']], function () {
        Route::delete('/{user}', 'Api\User\UserDestroy')->middleware('auth:api');
    });
});