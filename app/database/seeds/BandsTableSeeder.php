<?php

class BandsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('bands')->truncate();

		$bands = array(
			['name'=>'Leather', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'INOX', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('bands')->insert($bands);
	}

}
