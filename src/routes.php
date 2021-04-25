<?php
Route::group(['prefix' => 'admin', 'middleware' => ['web','can.access']], function () {
	Route::resource('permissions', '\LaravelHrabac\AccessControl\Controllers\PermissionController');
	Route::resource('roles', '\LaravelHrabac\AccessControl\Controllers\RoleController');
	Route::resource('users', '\LaravelHrabac\AccessControl\Controllers\UserController');
});

