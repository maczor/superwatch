<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watches', function(Blueprint $table) {
			$table->engine ='InnoDB';
			$table->increments('id');
			$table->unsignedInteger('brand_id');
			$table->unsignedInteger('model_id');
			$table->unsignedInteger('movement_id');
			$table->unsignedInteger('casebox_id');
			$table->unsignedInteger('band_id');
			$table->unsignedInteger('buckle_id');
			$table->unsignedInteger('status_id');
			$table->unsignedInteger('payment_id');
			$table->unsignedInteger('paper_id');
			$table->boolean('box')->default(false);
			$table->integer('year');
			$table->string('reference');
			$table->integer('sellingprice');
			$table->integer('buyingprice');
			$table->date('sellingdate')->nullable();
			$table->string('size');
			$table->string('video');
			$table->foreign('brand_id')->references('id')->on('brands');
			$table->foreign('model_id')->references('id')->on('models');
			$table->foreign('movement_id')->references('id')->on('movements');
			$table->foreign('casebox_id')->references('id')->on('caseboxes');
			$table->foreign('band_id')->references('id')->on('bands');
			$table->foreign('buckle_id')->references('id')->on('buckles');
			$table->foreign('status_id')->references('id')->on('statuses');
			$table->foreign('payment_id')->references('id')->on('payments');
			$table->foreign('paper_id')->references('id')->on('papers');
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
		Schema::drop('watches');
	}

}
