<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrivilegeFunctionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privilege_function', function(Blueprint $table)
		{
			$table->integer('system_function_id')->unsigned()->index('fk_system_function_has_privilege_system_function1_idx');
			$table->integer('privilege_id')->unsigned()->index('fk_system_function_has_privilege_privilege1_idx');
			$table->dateTime('created_at')->nullable();
			$table->dateTime('update_at')->nullable();
			$table->integer('created_by')->nullable();
			$table->primary(['system_function_id','privilege_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('privilege_function');
	}

}
