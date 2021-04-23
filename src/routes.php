<?php

Route::prefix('admin')->group(['middleware' => 'canAccess'], function () {
	Route::resource('permissions', 'Laravelroles\Rolespermissions\Controllers\PermissionController');
	Route::resource('roles', 'Laravelroles\Rolespermissions\Controllers\RoleController');
	Route::resource('users', 'Laravelroles\Rolespermissions\Controllers\UserController');
});
