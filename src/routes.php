<?php
Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
	Route::resource('permissions', '\LaravelHrabac\AccessControl\Controllers\PermissionController')->except('show')->middleware('can.access');
	Route::resource('roles', '\LaravelHrabac\AccessControl\Controllers\RoleController')->except('show')->middleware('can.access');
	Route::resource('users', '\LaravelHrabac\AccessControl\Controllers\UserController')->except('show')->middleware('can.access');
});

