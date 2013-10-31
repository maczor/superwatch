<?php

class MovementsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('movements')->truncate();

		$movements = array(
			['name'=>'Automatic', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Manual', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('movements')->insert($movements);
	}

}
