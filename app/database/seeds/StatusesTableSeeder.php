<?php

class StatusesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('statuses')->truncate();

		$statuses = array(
			['name'=>'not published', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'to sell', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'sold', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'reserved', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'in repair', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('statuses')->insert($statuses);
	}

}
