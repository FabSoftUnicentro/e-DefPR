<?php
Route::get('user/{user}', [
	'middleware' => ['auth', 'roles'],
	'uses' => 'UserController@index',
	'roles' => ['Defender', 'Legal advisor', 'Administrative Technician in Law']
]);
