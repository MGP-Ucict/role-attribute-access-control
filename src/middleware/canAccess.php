<?php

namespace LaravelHrabac\AccessControl\Middleware;

use Closure;

class CanAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $className = null )
    {
		// Get the current route.
		$user = auth()->user();
		if (!$user)
			return redirect('/');
		$route =  $request->path();
		$method = $request->method();
		if ($user->is_active){
			$roles = $user->roles;
			foreach($roles as $role){
				if($role->is_active){
					$perms = $role->routes;
					foreach($perms as $perm){
						if($this->compareRoutes($route, $perm) && $method == $perm->method) {
					if (!$perm->getOwn() || ($perm->getOwn() && $user->ownsClass($className, $this->getId($route)))){
								return $next($request);
							}
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
	
	
	private function getId($route)
	{
		$flag = 0;
		$routeArray = explode( "/", $route);
		foreach ($routeArray as $routeIter)
		{
			if (is_numeric($routeIter)){
				$flag = $routeIter;
				break;
			}
		}
		return $flag;
	}
}
