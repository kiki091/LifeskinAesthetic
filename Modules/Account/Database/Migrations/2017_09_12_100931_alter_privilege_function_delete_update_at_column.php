<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPrivilegeFunctionDeleteUpdateAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumn('privilege_function','update_at'))
        {
            Schema::table('privilege_function', function(Blueprint $table)
            {
                $table->dropColumn('update_at');
                $table->dateTime('updated_at')->nullable();
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
        //
    }
}
