<?php

class PapersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('papers')->truncate();

		$papers = array(
			['name'=>'No', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Yes', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Yes & service', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('papers')->insert($papers);
	}

}
