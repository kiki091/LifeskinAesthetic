<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRolePrivilegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('role_privilege', function(Blueprint $table)
		{
			$table->foreign('privilege_id', 'fk_RolePrivilege_Privilege')->references('id')->on('privilege')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('role_id', 'fk_RolePrivilege_Role')->references('id')->on('role')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('role_privilege', function(Blueprint $table)
		{
			$table->dropForeign('fk_RolePrivilege_Privilege');
			$table->dropForeign('fk_RolePrivilege_Role');
		});
	}

}
