<?php
Route::group(['prefix' => 'admin'], function () {
	Route::resource('permissions', '\LaravelHrabac\AccessControl\Controllers\PermissionController')->except('show')->middleware('web', 'can.access');
	Route::resource('roles', '\LaravelHrabac\AccessControl\Controllers\RoleController')->except('show')->middleware('web', 'can.access');
	Route::resource('users', '\LaravelHrabac\AccessControl\Controllers\UserController')->except('show')->middleware('web', 'can.access');
});

