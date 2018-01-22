<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_role')->delete();
        
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'role_id' => 6,
                'created_at' => '2016-07-29 22:32:51',
                'updated_at' => '2016-07-29 22:32:53',
                'created_by' => 1,
            ),
        ));
        
        
    }
}