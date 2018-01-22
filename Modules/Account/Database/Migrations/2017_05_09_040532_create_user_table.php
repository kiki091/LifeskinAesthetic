<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('is_active')->default(1);
			$table->string('name', 100)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('password', 64)->nullable();
			$table->string('remember_token', 200)->nullable();
			$table->timestamps();
			$table->integer('created_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
