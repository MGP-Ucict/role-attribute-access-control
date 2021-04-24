<?php
namespace LaravelHrabac\AccessControl\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use LaravelHrabac\AccessControl\Models\Role;
use LaravelHrabac\AccessControl\Requests\UserRequest;
use Illuminate\Support\Facades\View;


class UserController extends Controller{

	public function create()
	{
		return View::make('rolespermissions/users/create')->with(['roles' => Role::all()]);
	}

	public function store(UserRequest $request)
	{
		$validated = $request->validated();
		$roles = $validated['roles'];
		unset($validated['roles']);
		if (isset($validated['password'])){
			$password = $validated['password'];
			unset($validated['password']);
			unset($validated['password_confirmation']);
			$encryptedPassword = bcrypt($password);
			$validated = array_merge(['password' => $encryptedPassword], $validated);
		}
		$user = User::create($validated);
		$user->roles()->attach($roles);

		return redirect()->route('users.index');
	}

	public function edit($user)
	{
		return View::make('rolespermissions/users/edit')->with([
		    'user' => $user,
            'roles' => Role::all(),
            'checkedRoles' => $user->roles()->allRelatedIds()->toArray()
        ]);
	}

	public function update(UserRequest $request, $user)
	{
		$validated = $request->validated();
		$roles = $validated['roles'];
		unset($validated['roles']);
		if (isset($validated['password'])){
			$password = $validated['password'];
			unset($validated['password']);
			unset($validated['password_confirmation']);
			$encryptedPassword = bcrypt($password);
			$validated = array_merge(['password' => $encryptedPassword], $validated);
		}
		if (!isset($validated['is_active'])){
			$validated = array_merge(['is_active' => false], $validated);
		}
		$user->update($validated);
		$user->roles()->sync($roles);

		return redirect()->route('users.index');
	}

	public function destroy($user)
	{
		$user->roles()->detach();
		$user->delete();
		return redirect()->route('users.index');
	}

	public function index()
	{
		return View::make('rolespermissions/users/index')->with(['users' => User::all()]);
	}
}
