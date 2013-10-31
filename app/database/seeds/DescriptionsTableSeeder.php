<?php

class DescriptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('descriptions')->truncate();

		$descriptions = array(
			['watch_id'=>'1', 'en'=>'Description one EN', 'fr'=>'Description one FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'2', 'en'=>'Description two EN', 'fr'=>'Description two FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'3', 'en'=>'Description three EN', 'fr'=>'Description three FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'en'=>'Description four EN', 'fr'=>'Description four FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('descriptions')->insert($descriptions);
	}

}
