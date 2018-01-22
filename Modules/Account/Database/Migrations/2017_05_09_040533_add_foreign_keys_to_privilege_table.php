<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPrivilegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('privilege', function(Blueprint $table)
		{
			$table->foreign('menu_id', 'fk_privilege_menu1')->references('id')->on('menu')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('system_id', 'fk_privilege_system1')->references('id')->on('system')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('privilege', function(Blueprint $table)
		{
			$table->dropForeign('fk_privilege_menu1');
			$table->dropForeign('fk_privilege_system1');
		});
	}

}
