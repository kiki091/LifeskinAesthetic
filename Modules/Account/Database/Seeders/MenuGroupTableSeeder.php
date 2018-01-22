<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class MenuGroupTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_group')->delete();
        
        \DB::table('menu_group')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'ACCOUNTS',
                'icon' => 'ico-dashboard',
                'order' => 3,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:26:06',
                'updated_at' => '2016-07-29 22:26:08',
                'created_by' => 1,
            ),
        ));
        
        
    }
}