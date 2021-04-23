<?php
use Illuminate\Support\Facades\DB; 

use Illuminate\Database\Seeder;

class RolesUsersSeeder extends Seeder{
	
	public function run(){

		DB::table('roles_users')->insert(
			[
				'role_id' => 1,
				'user_id' => 1,
				
			]
		);
	}
}
