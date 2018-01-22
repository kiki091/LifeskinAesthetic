<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemControllerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_controller', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->string('display_name', 150)->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_controller');
	}

}
