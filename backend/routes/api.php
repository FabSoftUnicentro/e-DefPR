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
//Route::prefix('user')->group(function () {
//    Route::post('/authenticate', 'Api\User\UserAuthenticate');
//    Route::post('/forgot-password', 'Api\User\UserForgotPassword');
//    Route::get('/logout', 'Api\User\UserLogout')->middleware('auth:api');
//    Route::get('/me', 'Api\User\UserInfo')->middleware('auth:api');
//    Route::get('/{user}/permissions', 'Api\User\UserAllPermissions')->middleware('auth:api');
//    Route::put('/reset-password', 'Api\User\UserResetPassword')->middleware('auth:api');
//    Route::put('/me', 'Api\User\UserInfoUpdate')->middleware('auth:api');
//
//    Route::group(['middleware' => ['permission:register-employee']], function () {
//        Route::post('/', 'Api\User\UserStore')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:assign-user-permission']], function () {
//        Route::put('/{user}/assign-permission/{permission}', 'Api\User\UserAssignPermission')->middleware('auth:api');
//        Route::put('/{user}/assign-permissions', 'Api\User\UserAssignPermissions')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:unassign-user-permission']], function () {
//        Route::put('/{user}/unassign-permission/{permission}', 'Api\User\UserUnassignPermission')->middleware('auth:api');
//        Route::put('/{user}/unassign-permissions', 'Api\User\UserUnassignPermissions')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:assign-user-role']], function () {
//        Route::put('/{user}/assign-role/{role}', 'Api\User\UserAssignRole')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:unassign-user-role']], function () {
//        Route::put('/{user}/unassign-role/{role}', 'Api\User\UserUnassignRole')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:update-employee']], function () {
//        Route::put('/{user}', 'Api\User\UserUpdate')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:read-employee']], function () {
//        Route::get('/{user}', 'Api\User\UserShow')->middleware('auth:api');
//        Route::get('/', 'Api\User\UserList')->middleware('auth:api');
//    });
//    Route::group(['middleware' => ['permission:delete-employee']], function () {
//        Route::delete('/{user}', 'Api\User\UserDestroy')->middleware('auth:api');
//    });
//});

// State routes
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

// City routes
Route::prefix('city')->group(function () {
    Route::get('/', 'Api\City\CityList')->middleware('auth:api');
    Route::get('/{city}', 'Api\City\CityShow')->middleware('auth:api');
    Route::get('/state/{id}', 'Api\City\CityFindByState')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-city']], function () {
        Route::post('/', 'Api\City\CityStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-city']], function () {
        Route::put('/{city}', 'Api\City\CityUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-city']], function () {
        Route::delete('/{city}', 'Api\City\CityDestroy')->middleware('auth:api');
    });
});

// Assisted routes
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

// Role routes
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

// Permission routes
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

// AttendmentType routes
Route::prefix('attendmentType')->group(function () {
    Route::group(['middleware' => ['permission:list-attendmentType']], function () {
        Route::get('/', 'Api\AttendmentType\AttendmentTypeList')->middleware('auth:api');
        Route::get('/{attendmentType}', 'Api\AttendmentType\AttendmentTypeShow')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:register-attendmentType']], function () {
        Route::post('/', 'Api\AttendmentType\AttendmentTypeStore')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:update-attendmentType']], function () {
        Route::put('/{attendmentType}', 'Api\AttendmentType\AttendmentTypeUpdate')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:delete-attendmentType']], function () {
        Route::delete('/{attendmentType}', 'Api\AttendmentType\AttendmentTypeDestroy')->middleware('auth:api');
    });
});

// Attendments routes
Route::prefix('attendment')->group(function () {
    Route::group(['middleware' => ['permission:list-attendment']], function () {
        Route::get('/', 'Api\Attendment\AttendmentList')->middleware('auth:api');
        Route::get('/{attendment}', 'Api\Attendment\AttendmentShow')->middleware('auth:api');
    });

    Route::group(['middleware' => ['permission:register-attendment']], function () {
        Route::post('/', 'Api\Attendment\AttendmentStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-attendment']], function () {
        Route::put('/{attendment}', 'Api\Attendment\AttendmentUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-attendment']], function () {
        Route::delete('/{attendment}', 'Api\Attendment\AttendmentDestroy')->middleware('auth:api');
    });
});

// Postcode routes
Route::prefix('postcode')->group(function () {
    Route::get('/{postcode}', 'Api\Postcode\PostcodeSearch');
});

// CounterPart routes
Route::prefix('counter-part')->group(function () {
    Route::get('/', 'Api\CounterPart\CounterPartList')->middleware('auth:api');
    Route::get('/{counterPart}', 'Api\CounterPart\CounterPartShow')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-counterPart']], function () {
        Route::post('/', 'Api\CounterPart\CounterPartStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-counterPart']], function () {
        Route::put('/{counterPart}', 'Api\CounterPart\CounterPartUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-counterPart']], function () {
        Route::delete('/{counterPart}', 'Api\CounterPart\CounterPartDestroy')->middleware('auth:api');
    });
});

// Relative routes
Route::prefix('relative')->group(function () {
    Route::get('/', 'Api\Relative\RelativeList')->middleware('auth:api');
    Route::get('/{relative}', 'Api\Relative\RelativeShow')->middleware('auth:api');

    Route::group(['middleware' => ['permission:register-relative']], function () {
        Route::post('/', 'Api\Relative\RelativeStore')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:update-relative']], function () {
        Route::put('/{relative}', 'Api\Relative\RelativeUpdate')->middleware('auth:api');
    });
    Route::group(['middleware' => ['permission:delete-relative']], function () {
        Route::delete('/{relative}', 'Api\Relative\RelativeDestroy')->middleware('auth:api');
    });
});
