<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 150)->nullable();
			$table->integer('order')->nullable();
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
		Schema::drop('system');
	}

}
