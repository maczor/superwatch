<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descriptions', function(Blueprint $table) {
			$table->engine ='InnoDB';
			$table->increments('id');
			$table->unsignedInteger('watch_id');
			$table->text('en');
			$table->text('fr');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('descriptions');
	}

}
