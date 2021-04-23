<?php
namespace LaravelHrabac\AccessControl\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelHrabac\AccessControl\Models\Permission;
use LaravelHrabac\AccessControl\Requests\RouteRequest;
use Illuminate\Support\Facades\View;

class PermissionController extends Controller{

	public function create()
	{
		return View::make('rolespermissions/permissions/create');
	}

	public function store(RouteRequest $request)
	{
		$validated = $request->validated();
		Permission::create($validated);

		return redirect()->route('permissions.index');
	}

	public function edit($permission)
    {
		return View::make('rolespermissions/permissions/edit')->with(['permission' => $permission]);
	}

	public function update(RouteRequest $request, $permission)
	{
		$validated = $request->validated();
		$permission->update($validated);

		return redirect()->route('permissions.index');
	}

	public function destroy($permission)
	{
		$permission->delete();

		return redirect()->route('permissions.index');
	}

	public function index()
	{
		return View::make('rolespermissions/permissions/index')->with(['permissions' => Permission::all()]);
	}
}
