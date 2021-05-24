<?php
Route::group(['prefix' => 'admin', 'middleware' => ['web','can.access']], function () {
	Route::resource('permissions', '\LaravelHrabac\AccessControl\Controllers\PermissionController')->except('show');
	Route::resource('roles', '\LaravelHrabac\AccessControl\Controllers\RoleController')->except('show');
	Route::resource('users', '\LaravelHrabac\AccessControl\Controllers\UserController')->except('show');
});

