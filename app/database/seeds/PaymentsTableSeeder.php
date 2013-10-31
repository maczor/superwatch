<?php

class PaymentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('payments')->truncate();

		$payments = array(
			['name'=>'None', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Visa', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Mastercard', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'American Express', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Cash', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'Transfer', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['name'=>'CB', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('payments')->insert($payments);
	}

}
