<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeyToDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('descriptions', function(Blueprint $table) {
			$table->foreign('watch_id')->references('id')->on('watches')->onDelete('CASCADE')->onUpdate('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('descriptions', function(Blueprint $table) {
			$table->dropForeign('descriptions_watch_id_foreign');
		});
	}
}