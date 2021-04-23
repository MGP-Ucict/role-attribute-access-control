<?php

namespace LaravelHrabac\AccessControl\Middleware;

use Closure;

class canAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		// Get the current route.
		$user = auth()->user();
		if (!$user)
			return redirect('/');
		$route =  $request->path();
		$method = $request->method();
		if ($user->is_active){
			$roles = $user->roles()->get();
			foreach($roles as $role){
				if($role->is_active){
					$perms = $role->routes()->get();
					foreach($perms as $perm){
						if($this->compareRoutes($route, $perm) && $method == $perm->method) {
							return $next($request);
						  }
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
				$cntr++;
			}
		}
		return $flag;
	}
}
