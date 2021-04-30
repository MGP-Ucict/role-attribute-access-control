<?php

namespace LaravelHrabac\AccessControl\Models;

use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'route','method',
    ];
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	protected $primaryKey = 'id';
	protected $table = 'permissions';
	public $timestamps=false;

	public function roles()
	{
		return $this->belongsToMany('LaravelHrabac\AccessControl\Models\Role', 'permissions_roles', 'permission_id', 'role_id')->withPivot('own');
	}
	
	public function getOwn()
	{
		$flag = 0;
		foreach(auth()->user()->roles as $role){
			if (in_array($this->id, $role->getOwn())){
				$flag = 1;
			}
		}
		return $flag;
	}
}
