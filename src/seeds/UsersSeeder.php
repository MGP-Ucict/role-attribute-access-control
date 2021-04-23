<?php
use Illuminate\Support\Facades\DB; 

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder{
	
	public function run(){

		DB::table('users')->insert(
			[
				'name' => 'test',
				'email'=> 'test@test.bg',
				'password' => bcrypt('test'),
				'is_active' => true,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now()

			]
		);
	}
}
