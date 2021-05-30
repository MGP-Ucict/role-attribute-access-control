<?php

namespace LaravelHrabac\AccessControl\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'email', 'password','is_active',
    ];

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
	protected $table = 'users';
	public $timestamps = true;

	public function roles()
	{
		return $this->belongsToMany('LaravelHrabac\AccessControl\Models\Role', 'roles_users', 'user_id', 'role_id');
	}

	public function canAccess($permission)
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->canAccess($permission)) {
                return true;
            }
        }
        return false;
    }

	public function ownsClass($className, $id)
	{
		$flag = false;
		$intId = (int)$id;
		if ($className) {
			$model = $className::find($id);
			if (isset($model) && isset($model->user_id)){
				if ($intId > 0 && $model->user_id === $intId && auth()->user()->id === $intId){
					$flag = true;
				}
			}
		}
		return $flag;
	}
	
	public function isOwned($permission)
	{
		$roles = $this->roles;
		foreach($roles as $role){
			if ($role->isOwned($permission)){
				return true;
			}
		}
        return  false;
	}
	
	public function ownModel($model) 
	{
		if (isset($model->user_id)){
			if ($model->user_id === $this->id){
				return true;
			}
		}
		return false;
	}
}
