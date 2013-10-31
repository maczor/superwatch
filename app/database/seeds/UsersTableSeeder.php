<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
			['email'=>'antoine@arts-square.com', 'name'=>'Antoine Helsmoortel', 'password'=>Hash::make('ant0in3'), 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['email'=>'maczor@maczor.com', 'name'=>'maczor', 'password'=>Hash::make('kac6229'), 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
