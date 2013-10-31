<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('ModelsTableSeeder');
		$this->call('BrandsTableSeeder');
		$this->call('MovementsTableSeeder');
		$this->call('CaseboxesTableSeeder');
		$this->call('BandsTableSeeder');
		$this->call('BucklesTableSeeder');
		$this->call('StatusesTableSeeder');
		$this->call('PaymentsTableSeeder');
		$this->call('PapersTableSeeder');
		$this->call('WatchesTableSeeder');
		$this->call('ImagesTableSeeder');
		$this->call('KeywordsTableSeeder');
		$this->call('DescriptionsTableSeeder');
	}

}