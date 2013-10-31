<?php

class CaseboxesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('caseboxes')->truncate();

		$caseboxes = array(
			['name'=>'Titanium', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Gold', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('caseboxes')->insert($caseboxes);
	}

}
