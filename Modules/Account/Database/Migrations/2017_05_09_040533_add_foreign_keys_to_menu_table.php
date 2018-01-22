<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu', function(Blueprint $table)
		{
			$table->foreign('menu_group_id', 'fk_menu_menu_group1')->references('id')->on('menu_group')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu', function(Blueprint $table)
		{
			$table->dropForeign('fk_menu_menu_group1');
		});
	}

}
