<?php

namespace LaravelHrabac\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id',  'name', 'is_active',
    ];


	protected $table = 'roles';
	public $timestamps = true;

	public function routes()
	{
		return $this->belongsToMany('Laravelroles\Rolespermissions\Models\Permission', 'permissions_roles', 'role_id', 'permission_id');
	}

	public function users()
	{
		return $this->belongsToMany('Laravelroles\Rolespermissions\Models\User');
	}

	public function hasAccess($permission)
    {
        if ($this->hasPermission($permission)){
            return true;
		}
        return false;
    }

	public function getCheckedPermissions()
	{
		return $this->routes()->allRelatedIds()->toArray();
	}

    private function hasPermission($permission)
    {
		$routes = $this->routes;
		foreach($routes as $route){
			if ($route->name == $permission){
				return true;
			}
		}
        return  false;
    }


}
