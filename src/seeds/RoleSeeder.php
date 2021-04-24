<?php
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder{
	
	public function run(){

		DB::table('roles')->insert(
			[
				'name' => 'admin',
				'is_active' => true,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()

			]
		);
	}
}
