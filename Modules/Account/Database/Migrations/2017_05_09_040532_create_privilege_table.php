<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrivilegeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('privilege', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 150)->nullable()->comment('buat yg folder levelnya dibawah sub menu');
			$table->text('desc', 65535)->nullable();
			$table->integer('order')->unsigned()->default(1)->index('index_Privilege_order');
			$table->integer('system_id')->unsigned()->index('fk_privilege_system1_idx');
			$table->timestamps();
			$table->integer('created_by')->nullable();
			$table->integer('menu_id')->unsigned()->nullable()->index('fk_privilege_menu1_idx')->comment('if menu needed');
			$table->integer('folder_id')->unsigned()->nullable()->index('fk_privilege_folder1_idx')->comment('if folder needed');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('privilege');
	}

}
