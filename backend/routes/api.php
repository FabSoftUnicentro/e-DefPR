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

// User routes
Route::prefix('user')->group(function () {
    Route::post('/authenticate', 'Api\UserController@authenticate');
    Route::post('/forgot-password', 'Api\UserController@forgotPassword');
    Route::get('/me', 'Api\UserController@info')->middleware('auth:api');
    Route::put('/reset-password', 'Api\UserController@resetPassword')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-employee']], function () {
        Route::post('/', 'Api\UserController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:assign-user-permission']], function () {
        Route::put('/{id}/assign-permission/{permission}', 'Api\UserController@assignPermission')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:unassign-user-permission']], function () {
        Route::put('/{id}/unassign-permission/{permission}', 'Api\UserController@unassignPermission')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:assign-user-role']], function () {
        Route::put('/{id}/assign-role/{role}', 'Api\UserController@assignRole')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:unassign-user-role']], function () {
        Route::put('/{id}/unassign-role/{role}', 'Api\UserController@unassignRole')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:update-employee']], function () {
        Route::put('/{id}', 'Api\UserController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:read-employee']], function () {
        Route::get('/{id}', 'Api\UserController@show')->middleware('auth:api')->where('id', '[0-9]+');
        Route::get('/', 'Api\UserController@index')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-employee']], function () {
        Route::delete('/{id}', 'Api\UserController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
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
    Route::get('/{id}', 'Api\AssistedController@show')->middleware('auth:api')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:register-assisted']], function () {
        Route::post('/', 'Api\AssistedController@store')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-assisted']], function () {
        Route::put('/{id}', 'Api\AssistedController@update')->middleware('auth:api')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:delete-assisted']], function () {
        Route::delete('/{id}', 'Api\AssistedController@destroy')->middleware('auth:api')->where('id', '[0-9]+');
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
    });
    Route::group(['middleware' => ['permission:unassign-role-permission']], function () {
        Route::put('/{id}/unassign-permission/{permission}', 'Api\RoleController@unassignPermission')->middleware('auth:api')->where('id', '[0-9]+');
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
