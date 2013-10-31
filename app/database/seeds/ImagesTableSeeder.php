<?php

class ImagesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('images')->truncate();

		$images = array(
			['watch_id'=>'1', 'filename'=>'1image1.jpg', 'order'=>'1', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'1', 'filename'=>'1image2.jpg', 'order'=>'2', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'1', 'filename'=>'1image3.jpg', 'order'=>'3', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'1', 'filename'=>'1image4.jpg', 'order'=>'4', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'2', 'filename'=>'2image1.jpg', 'order'=>'1', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'2', 'filename'=>'2image2.jpg', 'order'=>'2', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'2', 'filename'=>'2image3.jpg', 'order'=>'3', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'3', 'filename'=>'3image1.jpg', 'order'=>'1', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'3', 'filename'=>'3image2.jpg', 'order'=>'2', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'3', 'filename'=>'3image3.jpg', 'order'=>'3', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'filename'=>'4image1.jpg', 'order'=>'1', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'filename'=>'4image2.jpg', 'order'=>'2', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'filename'=>'4image3.jpg', 'order'=>'3', 'created_at'=>new DateTime, 'updated_at' => new DateTime],
			['watch_id'=>'4', 'filename'=>'4image4.jpg', 'order'=>'4', 'created_at'=>new DateTime, 'updated_at' => new DateTime]
		);

		// Uncomment the below to run the seeder
		// DB::table('images')->insert($images);
	}

}
