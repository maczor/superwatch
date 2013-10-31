<?php

class KeywordsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('keywords')->truncate();

		$keywords = array(
			['watch_id'=>'1', 'en'=>'word one, word two, word three EN', 'fr'=>'word one, word two, word three FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'2', 'en'=>'secondword one, secondword two, secondword three EN', 'fr'=>'secondword one, secondword two, secondword three FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'3', 'en'=>'thirdword one, thirdword two, thirdword three EN', 'fr'=>'thirdword one, thirdword two, thirdword three FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'en'=>'fourthword one, fourthword two, thirdword three EN', 'fr'=>'thirdword one, thirdword two, thirdword three FR', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('keywords')->insert($keywords);
	}

}
