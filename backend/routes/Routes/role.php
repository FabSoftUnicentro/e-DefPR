<?php

Route::prefix('role')->group(function () {
    Route::get('/{role}/permissions', 'Api\Role\RoleAllPermissions')->middleware('auth:api');

    Route::group(['middleware' => ['permission:read-role']], function () {
        Route::get('/', 'Api\Role\RoleList')->middleware('auth:api');
        Route::get('/{role}', 'Api\Role\RoleShow')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:register-role']], function () {
        Route::post('/', 'Api\Role\RoleStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-role']], function () {
        Route::put('/{role}', 'Api\Role\RoleUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-role']], function () {
        Route::delete('/{role}', 'Api\Role\RoleDestroy')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:assign-role-permission']], function () {
        Route::put('/{role}/assign-permission/{permission}', 'Api\Role\RoleAssignPermission')->middleware('auth:api');
        Route::put('/{role}/assign-permissions', 'Api\Role\RoleAssignPermissions')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:unassign-role-permission']], function () {
        Route::put('/{role}/unassign-permission/{permission}', 'Api\Role\RoleUnassignPermission')->middleware('auth:api');
        Route::put('/{role}/unassign-permissions', 'Api\Role\RoleUnassignPermissions')->middleware('auth:api');
    });
});