<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePrivilegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_privilege', function(Blueprint $table)
		{
			$table->integer('role_id')->unsigned()->index('fk_RolePrivilege_Role_idx');
			$table->integer('privilege_id')->unsigned()->index('fk_RolePrivilege_Privilege_idx');
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->primary(['role_id','privilege_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_privilege');
	}

}
