<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenuGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_group', function(Blueprint $table)
		{
			$table->foreign('system_id', 'fk_menu_group_system1')->references('id')->on('system')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu_group', function(Blueprint $table)
		{
			$table->dropForeign('fk_menu_group_system1');
		});
	}

}
