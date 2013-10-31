<?php

class WatchesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('watches')->truncate();

		$watches = array(
			['brand_id'=>1, 'model_id'=>1, 'movement_id'=>1, 'casebox_id'=>2, 'band_id'=>1, 'buckle_id'=>2, 'paper_id'=>1, 'box'=>1, 'status_id'=>1, 'payment_id'=>1, 'year'=>2010, 'reference'=>'some reference', 'sellingprice'=>1200, 'buyingprice'=>1000, 'sellingdate'=>new DateTime('2014-01-01'), 'size'=>'XS', 'video'=>'http://vimeo.com/1', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['brand_id'=>2, 'model_id'=>2, 'movement_id'=>2, 'casebox_id'=>2, 'band_id'=>1, 'buckle_id'=>1, 'paper_id'=>2, 'box'=>1, 'status_id'=>2, 'payment_id'=>2, 'year'=>2011, 'reference'=>'some reference', 'sellingprice'=>1300, 'buyingprice'=>1100, 'sellingdate'=>null, 'size'=>'M', 'video'=>'http://vimeo.com/2', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['brand_id'=>3, 'model_id'=>3, 'movement_id'=>2, 'casebox_id'=>1, 'band_id'=>2, 'buckle_id'=>1, 'paper_id'=>3, 'box'=>0, 'status_id'=>3, 'payment_id'=>3, 'year'=>2012, 'reference'=>'some reference', 'sellingprice'=>1400, 'buyingprice'=>1200, 'sellingdate'=>null, 'size'=>'Some size', 'video'=>'http://vimeo.com/3', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['brand_id'=>4, 'model_id'=>4, 'movement_id'=>1, 'casebox_id'=>1, 'band_id'=>2, 'buckle_id'=>2, 'paper_id'=>1, 'box'=>1, 'status_id'=>4, 'payment_id'=>4, 'year'=>2013, 'reference'=>'some reference', 'sellingprice'=>1500, 'buyingprice'=>1200, 'sellingdate'=>null, 'size'=>'46 mm', 'video'=>'http://vimeo.com/4', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		DB::table('watches')->insert($watches);
	}

}
