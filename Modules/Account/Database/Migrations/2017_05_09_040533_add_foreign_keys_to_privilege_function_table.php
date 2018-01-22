<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPrivilegeFunctionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('privilege_function', function(Blueprint $table)
		{
			$table->foreign('privilege_id', 'fk_system_function_has_privilege_privilege1')->references('id')->on('privilege')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('system_function_id', 'fk_system_function_has_privilege_system_function1')->references('id')->on('system_function')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('privilege_function', function(Blueprint $table)
		{
			$table->dropForeign('fk_system_function_has_privilege_privilege1');
			$table->dropForeign('fk_system_function_has_privilege_system_function1');
		});
	}

}
