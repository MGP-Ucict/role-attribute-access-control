<?php

namespace Laravelroles\Rolespermissions\Middleware;
use Closure;

class ProtectModelsOwnedByUser
{
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $className)
    {
		// Get the current route.
		$user = $request->user();
		if (!$user){
			return redirect('/');
		}
		$route =  $request->path();
		$method = $request->method();
		if ($user->is_active){
			$roles = $user->roles()->get();
			foreach($roles as $role){
				if($role->is_active){
					$routeArray = explode( "/", $route);
					$count = count($routeArray)-1;
					$id = $routeArray[$count];
					if ($user->ownsClass($className, $id)){
						return $next($request);
					}				
					$perms = $role->routes()->get();
					foreach($perms as $perm){
						if($this->compareRoutes($route, $perm) && $method == $perm->method)
							return $next($request);
					}
				}
			}
		}
		return abort(403);
    }
	
	private function compareRoutes($route, $iterRoute){
		$flag = false;
		$routeArray = [];
		$routeArray = explode( "/", $route);
			
		$iterRouteArray = [];	
		$iterRouteArray = explode("/", $iterRoute->route);
		$cntr = 0;
		$length = count($routeArray) - 1;
		$iterLength = count($iterRouteArray) - 1;
		if($length == $iterLength){
			$flag = true;
			while($cntr <= $length){
				if(!is_numeric($routeArray[$cntr]) && $iterRouteArray[$cntr] != $routeArray[$cntr]){
					$flag = false;
					break;
				}
				if(is_numeric($routeArray[$cntr]) && $cntr == $length){
					$flag = false;
				}
				$cntr++;
			}
		}
		return $flag;
	}
}