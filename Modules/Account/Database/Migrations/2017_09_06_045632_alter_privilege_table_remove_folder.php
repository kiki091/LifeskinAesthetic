<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterPrivilegeTableRemoveFolder extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasColumn('privilege','folder_id'))
		{
			Schema::table('privilege', function(Blueprint $table)
			{
				$table->dropColumn('folder_id');
			});	
		}
		
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
			$table->integer('folder_id')->unsigned()->nullable()->index('fk_privilege_folder1_idx')->comment('if folder needed');
		});
	}

}
