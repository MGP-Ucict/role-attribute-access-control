<?php
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder{
	
	public function run(){
		$routeCollection = Route::getRoutes();
		$i = 1;
		foreach ($routeCollection as $value) {
			$arrayRoute = explode('/', $value->uri());
			$prefix = $arrayRoute[0];
			if($prefix != "admin"){
				continue;
			}
			$permission = DB::table('permissions')->insert(
				[
					'id' => $i,
					'name' => $value->getName(),
					'route' => $value->uri(),
					'method' => $value->methods()[0],
					'created_at' => \Carbon\Carbon::now(),
					'updated_at' => \Carbon\Carbon::now()

				]
			);
			DB::table('permissions_roles')->insert(
				[
					'permission_id' => $i,
					'role_id' => 1,
					
				]
			);
			$i++;
		}
	}
}
