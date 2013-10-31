<?php

class BucklesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('buckles')->truncate();

		$buckles = array(
			['name'=>'Folding Clasp', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Some other', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('buckles')->insert($buckles);
	}

}
