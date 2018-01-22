<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemFunctionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_function', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 150);
			$table->string('display_name', 150)->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('system_controller_id')->unsigned()->index('fk_system_function_system_controller1_idx');
			$table->string('description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_function');
	}

}
