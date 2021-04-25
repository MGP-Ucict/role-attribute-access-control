<?php
namespace LaravelHrabac\AccessControl\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use LaravelHrabac\AccessControl\Models\Role;
use LaravelHrabac\AccessControl\Models\Permission;
use LaravelHrabac\AccessControl\Requests\RoleRequest;

class RoleController extends Controller{

	public function create()
	{
		return View::make('rolespermissions/roles/create')->with(['permissions' => Permission::all()]);
	}

	public function store(RoleRequest $request)
	{
		$validated = $request->validated();
		$routes = $validated['routes'];
		unset($validated['routes']);
		$role = Role::create($validated);
		$role->routes()->attach($routes);

		return redirect()->route('roles.index');
	}


	public function edit(Role $role)
	{
		return View::make('rolespermissions/roles/edit')->with([
		    'role' => $role,
            'permissions' => Permission::all(),
            'checkedPermissions' =>  $role->getCheckedPermissions()
        ]);
	}

	public function update(RoleRequest $request, Role $role)
	{
		$validated = $request->validated();
		$permissions = $validated['routes'];
		unset($validated['routes']);
		if (!isset($validated['is_active'])){
			$validated = array_merge(['is_active' => false], $validated);
		}
		$role->update($validated);
		$role->routes()->sync($permissions);

		return redirect()->route('roles.index');
	}
	public function destroy(Role $role)
	{
		$role->routes()->detach();
		$role->delete();
		return redirect()->route('roles.index');
	}

	public function index()
    {
		return View::make('rolespermissions/roles/index')->with(['roles' => Role::all()]);
	}
}
