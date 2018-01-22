<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role')->delete();
        
        \DB::table('role')->insert(array (
            0 => 
            array (
                'id' => 6,
            'name' => 'Accounts Manager (Developer)',
            'desc' => 'Accounts Manager (Developer)',
                'order' => 1,
                'created_at' => '2016-08-02 15:47:58',
                'updated_at' => '2016-08-02 16:23:32',
                'created_by' => 1,
            ),
        ));
        
        
    }
}