<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class SystemTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system')->delete();
        
        \DB::table('system')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Account Management System',
                'order' => 3,
                'created_at' => '2016-07-29 22:24:26',
                'updated_at' => '2016-07-29 22:24:27',
                'created_by' => 1,
            ),
        ));
        
        
    }
}