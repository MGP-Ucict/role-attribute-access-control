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
		return $this->belongsToMany('LaravelHrabac\AccessControl\Models\Permission', 'permissions_roles', 'role_id', 'permission_id');
	}

	public function users()
	{
		return $this->belongsToMany('LaravelHrabac\AccessControl\Models\User');
	}

	public function canAccess($permission)
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

	public function getOwn()
	{
		return $this->routes()->where('own', 1)->pluck('permission_id')->toArray();
	}

    private function hasPermission($permission)
    {
		$routes = $this->routes;
		foreach($routes as $route){
			if ($route->name == $permission && !in_array($route->id, $this->getOwn())){
				return true;
			}
		}
        return  false;
    }
	
	public function isOwned($permission)
	{
		$routes = $this->routes;
		foreach($routes as $route){
			if ($route->name == $permission){
				if (in_array($route->id, $this->getOwn())) {
					return true;
				}
			}
		}
        return  false;
	}
}
