<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_role', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index('fk_user_has_role_user1_idx');
			$table->integer('role_id')->unsigned()->index('fk_user_has_role_role1_idx');
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->primary(['user_id','role_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_role');
	}

}
