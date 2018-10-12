<?php

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
    Route::post('/authenticate', 'Api\User\UserAuthenticate');
    Route::post('/forgot-password', 'Api\User\UserForgotPassword');
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

// State routes
Route::prefix('state')->group(function () {
    Route::get('/', 'Api\StateController@index')->middleware('auth:api');
    Route::get('/{id}', 'Api\StateController@show')->middleware('auth:api')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:register-state']], function () {
        Route::post('/', 'Api\StateController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-state']], function () {
        Route::put('/{id}', 'Api\StateController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-state']], function () {
        Route::delete('/{id}', 'Api\StateController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// City routes
Route::prefix('city')->group(function () {
    Route::get('/', 'Api\CityController@index')->middleware('auth:api');
    Route::get('/{id}', 'Api\CityController@show')->middleware('auth:api')->where('id', '[0-9]+');
    Route::get('/state/{id}', 'Api\CityController@findByState')->middleware('auth:api')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:register-city']], function () {
        Route::post('/', 'Api\CityController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-city']], function () {
        Route::put('/{id}', 'Api\CityController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-city']], function () {
        Route::delete('/{id}', 'Api\CityController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// Assisted route
Route::prefix('assisted')->group(function () {
    Route::get('/', 'Api\AssistedController@index')->middleware('auth:api');
    Route::get('/{assisted}', 'Api\AssistedController@show')->middleware('auth:api')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:register-assisted']], function () {
        Route::post('/', 'Api\AssistedController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-assisted']], function () {
        Route::put('/{assisted}', 'Api\AssistedController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-assisted']], function () {
        Route::delete('/{assisted}', 'Api\AssistedController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// Role route
Route::prefix('role')->group(function () {
    Route::group(['middleware' => ['permission:read-role']], function () {
        Route::get('/', 'Api\RoleController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\RoleController@show')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:register-role']], function () {
        Route::post('/', 'Api\RoleController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:assign-role-permission']], function () {
        Route::put('/{id}/assign-permission/{permission}', 'Api\RoleController@assignPermission')->middleware('auth:api')->where('id', '[0-9]+');
        Route::put('/{role}/assign-permissions', 'Api\RoleController@assignPermissions')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:unassign-role-permission']], function () {
        Route::put('/{id}/unassign-permission/{permission}', 'Api\RoleController@unassignPermission')->middleware('auth:api')->where('id', '[0-9]+');
        Route::put('/{role}/unassign-permissions', 'Api\RoleController@unassignPermissions')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:update-role']], function () {
        Route::put('/{id}', 'Api\RoleController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-role']], function () {
        Route::delete('/{id}', 'Api\RoleController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// Permission route
Route::prefix('permission')->group(function () {
    Route::group(['middleware' => ['permission:list-permission']], function () {
        Route::get('/', 'Api\PermissionController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\PermissionController@show')->middleware('auth:api')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => ['permission:register-permission']], function () {
        Route::post('/', 'Api\PermissionController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-permission']], function () {
        Route::put('/{id}', 'Api\PermissionController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-permission']], function () {
        Route::delete('/{id}', 'Api\PermissionController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// AttendmentType route
Route::prefix('attendmentType')->group(function () {
    Route::group(['middleware' => ['permission:list-attendmentType']], function () {
        Route::get('/', 'Api\AttendmentTypeController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\AttendmentTypeController@show')->middleware('auth:api')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => ['permission:register-attendmentType']], function () {
        Route::post('/', 'Api\AttendmentTypeController@store')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:update-attendmentType']], function () {
        Route::put('/{id}', 'Api\AttendmentTypeController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => ['permission:delete-attendmentType']], function () {
        Route::delete('/{id}', 'Api\AttendmentTypeController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});

// Attendments route
Route::prefix('attendment')->group(function () {
    Route::group(['middleware' => ['permission:list-attendment']], function () {
        Route::get('/', 'Api\AttendmentController@index')->middleware('auth:api');
        Route::get('/{id}', 'Api\AttendmentController@show')->middleware('auth:api')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => ['permission:register-attendment']], function () {
        Route::post('/', 'Api\AttendmentController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-attendment']], function () {
        Route::put('/{id}', 'Api\AttendmentController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-attendment']], function () {
        Route::delete('/{id}', 'Api\AttendmentController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
    });
});
