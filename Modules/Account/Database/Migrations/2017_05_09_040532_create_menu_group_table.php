<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 150)->nullable();
			$table->integer('order')->nullable();
			$table->string('icon', 45)->nullable();
			$table->integer('system_id')->unsigned()->index('fk_menu_group_system1_idx');
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
		Schema::drop('menu_group');
	}

}
