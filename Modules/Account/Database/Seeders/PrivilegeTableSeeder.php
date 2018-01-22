<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class PrivilegeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('privilege')->delete();
        
        \DB::table('privilege')->insert(array (
            0 => 
            array (
                'id' => 231,
                'name' => 'View Role Manager',
                'desc' => 'View Role Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 1,
            ),
            1 => 
            array (
                'id' => 232,
                'name' => 'Store Role Manager',
                'desc' => 'Store Role Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 1,
            ),
            2 => 
            array (
                'id' => 233,
                'name' => 'Edit Role Manager',
                'desc' => 'Edit Role Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 1,
            ),
            3 => 
            array (
                'id' => 234,
                'name' => 'Update Role Manager',
                'desc' => 'Update Role Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 1,
            ),
            4 => 
            array (
                'id' => 241,
                'name' => 'View Admin Manager',
                'desc' => 'View Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            5 => 
            array (
                'id' => 242,
                'name' => 'Store Admin Manager',
                'desc' => 'Store Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            6 => 
            array (
                'id' => 243,
                'name' => 'Edit Admin Manager',
                'desc' => 'Edit Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            7 => 
            array (
                'id' => 244,
                'name' => 'Update Admin Manager',
                'desc' => 'Update Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            8 => 
            array (
                'id' => 245,
                'name' => 'Delete Admin Manager',
                'desc' => 'Delete Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            9 => 
            array (
                'id' => 246,
                'name' => 'Change Status Admin Manager',
                'desc' => 'Change Status Admin Manager',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 2,
            ),
            10 => 
            array (
                'id' => 263,
                'name' => 'View Controller Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 3,
            ),
            11 => 
            array (
                'id' => 264,
                'name' => 'Store Controller Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 3,
            ),
            12 => 
            array (
                'id' => 265,
                'name' => 'Edit Controller Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 3,
            ),
            13 => 
            array (
                'id' => 266,
                'name' => 'Delete Controller Manager',
                'desc' => NULL,
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:37',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 3,
            ),
            14 => 
            array (
                'id' => 267,
                'name' => 'View Menu Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 4,
            ),
            15 => 
            array (
                'id' => 268,
                'name' => 'Store Menu Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 4,
            ),
            16 => 
            array (
                'id' => 269,
                'name' => 'Edit Menu Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 4,
            ),
            17 => 
            array (
                'id' => 270,
                'name' => 'Order Menu Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:37',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 4,
            ),
            18 => 
            array (
                'id' => 271,
                'name' => 'View Menu Group Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 5,
            ),
            19 => 
            array (
                'id' => 272,
                'name' => 'Store Menu Group Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 5,
            ),
            20 => 
            array (
                'id' => 273,
                'name' => 'Edit Menu Group Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 5,
            ),
            21 => 
            array (
                'id' => 274,
                'name' => 'Order Menu Group Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:37',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 5,
            ),
            22 => 
            array (
                'id' => 275,
                'name' => 'View Privilege Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 6,
            ),
            23 => 
            array (
                'id' => 276,
                'name' => 'Store Privilege Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 6,
            ),
            24 => 
            array (
                'id' => 277,
                'name' => 'Edit Privilege Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 6,
            ),
            25 => 
            array (
                'id' => 278,
                'name' => 'View Function Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 7,
            ),
            26 => 
            array (
                'id' => 279,
                'name' => 'Store Function Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 7,
            ),
            27 => 
            array (
                'id' => 280,
                'name' => 'Edit Function Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 7,
            ),
            28 => 
            array (
                'id' => 281,
                'name' => 'Delete Function Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 7,
            ),
            29 => 
            array (
                'id' => 282,
                'name' => 'Search Function Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 7,
            ),
            30 => 
            array (
                'id' => 283,
                'name' => 'View System Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 8,
            ),
            31 => 
            array (
                'id' => 284,
                'name' => 'Store System Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 8,
            ),
            32 => 
            array (
                'id' => 285,
                'name' => 'Edit System Manager',
                'desc' => '',
                'order' => 1,
                'system_id' => 3,
                'created_at' => '2016-07-29 22:24:35',
                'updated_at' => '2016-07-29 22:24:37',
                'created_by' => 1,
                'menu_id' => 8,
            ),
        ));
        
        
    }
}