<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('mail_jobs')) 
		{
			Schema::create('mail_jobs', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('view');
				$table->text('data', 65535);
				$table->boolean('status')->nullable()->default(0);
				$table->text('error', 65535)->nullable();
				$table->integer('created_by')->nullable();
				$table->timestamps();
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
		Schema::drop('mail_jobs');
	}

}
