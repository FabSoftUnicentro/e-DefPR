<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$this->get('/', 'Dashboard\DashboardIndex')->name('dashboard');

// User routes
$this->group(['middleware' => ['auth'], 'namespace' => 'User', 'prefix' => 'users'], function() {
    $this->get('/me', 'UserInfo')->name('user.profile');
    $this->put('/me', 'UserInfoUpdate')->name('user.profile.update');

    $this->group(['middleware' => ['permission:register-employee']], function () {
        $this->get('/create', 'UserCreate')->name('users.create');
        $this->post('/', 'UserStore')->name('users.store');
    });
    $this->group(['middleware' => ['permission:assign-user-permission']], function () {
        $this->put('/{user}/assign-permission/{permission}', 'UserAssignPermission')->name('users.assign.permission');
        $this->put('/{user}/assign-permissions', 'UserAssignPermissions')->name('users.assign.permissions');;
    });
    $this->group(['middleware' => ['permission:unassign-user-permission']], function () {
        $this->put('/{user}/unassign-permission/{permission}', 'UserUnassignPermission')->name('users.unassign.permission');;
        $this->put('/{user}/unassign-permissions', 'UserUnassignPermissions')->name('users.unassign.permissions');;
    });
    $this->group(['middleware' => ['permission:assign-user-role']], function () {
        $this->put('/{user}/assign-role/{role}', 'UserAssignRole')->name('users.assign.role');;
    });
    $this->group(['middleware' => ['permission:unassign-user-role']], function () {
        $this->put('/{user}/unassign-role/{role}', 'UserUnassignRole')->name('users.assign.role');;
    });
    $this->group(['middleware' => ['permission:update-employee']], function () {
        $this->get('/{user}/edit', 'UserEdit')->name('users.edit');
        $this->put('/{user}', 'UserUpdate')->name('users.update');
    });
    $this->group(['middleware' => ['permission:read-employee']], function () {
        $this->get('/list', 'UserList')->name('users.list');
        $this->get('/', 'UserIndex')->name('users.index');
        $this->get('/{user}', 'UserShow')->name('users.show');
    });
    $this->group(['middleware' => ['permission:delete-employee']], function () {
        $this->delete('/{user}', 'UserDestroy')->name('users.destroy');
    });
});

// Postcode routes
$this->group(['middleware' => ['auth'], 'namespace' => 'Postcode', 'prefix' => 'postcode'], function() {
    $this->get('/{postcode}', 'PostcodeSearch')->name('postcode.search');
});

$this->get('/page-not-found', function () {
    return view('error.404');
})->name('404');

$this->get('/internal-server-error', function () {
    return view('error.500');
})->name('500');

Auth::routes();
