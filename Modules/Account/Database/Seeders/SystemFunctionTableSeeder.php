<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class SystemFunctionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_function')->delete();
        
        \DB::table('system_function')->insert(array (
            0 => 
            array (
                'id' => 5,
                'name' => 'index',
                'display_name' => 'Index Role Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 3,
                'description' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'name' => 'getData',
                'display_name' => 'Get Data Role Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 3,
                'description' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'name' => 'store',
                'display_name' => 'Store Role Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 3,
                'description' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'name' => 'edit',
                'display_name' => 'Edit Role Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 3,
                'description' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'name' => 'update',
                'display_name' => 'Update Role Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 3,
                'description' => NULL,
            ),
            12 => 
            array (
                'id' => 17,
                'name' => 'index',
                'display_name' => 'Index Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            13 => 
            array (
                'id' => 18,
                'name' => 'getData',
                'display_name' => 'Get Data Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            14 => 
            array (
                'id' => 19,
                'name' => 'store',
                'display_name' => 'Store Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            15 => 
            array (
                'id' => 20,
                'name' => 'edit',
                'display_name' => 'Edit Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            16 => 
            array (
                'id' => 21,
                'name' => 'update',
                'display_name' => 'Update Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            17 => 
            array (
                'id' => 22,
                'name' => 'delete',
                'display_name' => 'Delete Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            18 => 
            array (
                'id' => 23,
                'name' => 'changeStatus',
                'display_name' => 'Change Status Admin Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 5,
                'description' => NULL,
            ),
            19 => 
            array (
                'id' => 45,
                'name' => 'index',
                'display_name' => 'Index System Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 11,
                'description' => NULL,
            ),
            20 => 
            array (
                'id' => 46,
                'name' => 'getData',
                'display_name' => 'Get Data System Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 11,
                'description' => NULL,
            ),
            21 => 
            array (
                'id' => 47,
                'name' => 'store',
                'display_name' => 'Store System Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 11,
                'description' => NULL,
            ),
            22 => 
            array (
                'id' => 48,
                'name' => 'edit',
                'display_name' => 'Edit System Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 11,
                'description' => NULL,
            ),
            23 => 
            array (
                'id' => 49,
                'name' => 'index',
                'display_name' => 'Index Menu Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 8,
                'description' => NULL,
            ),
            24 => 
            array (
                'id' => 50,
                'name' => 'getData',
                'display_name' => 'Get Data Menu Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 8,
                'description' => NULL,
            ),
            25 => 
            array (
                'id' => 51,
                'name' => 'store',
                'display_name' => 'Store Menu Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 8,
                'description' => NULL,
            ),
            26 => 
            array (
                'id' => 52,
                'name' => 'edit',
                'display_name' => 'Edit Menu Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 8,
                'description' => NULL,
            ),
            27 => 
            array (
                'id' => 53,
                'name' => 'order',
                'display_name' => 'Order Menu Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
                'system_controller_id' => 8,
                'description' => NULL,
            ),
            28 => 
            array (
                'id' => 54,
                'name' => 'index',
                'display_name' => 'Index Menu Group Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 9,
                'description' => NULL,
            ),
            29 => 
            array (
                'id' => 55,
                'name' => 'getData',
                'display_name' => 'Get Data Menu Group Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 9,
                'description' => NULL,
            ),
            30 => 
            array (
                'id' => 56,
                'name' => 'store',
                'display_name' => 'Store Menu Group Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 9,
                'description' => NULL,
            ),
            31 => 
            array (
                'id' => 57,
                'name' => 'edit',
                'display_name' => 'Edit Menu Group Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 9,
                'description' => NULL,
            ),
            32 => 
            array (
                'id' => 58,
                'name' => 'order',
                'display_name' => 'Order Menu Group Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
                'system_controller_id' => 9,
                'description' => NULL,
            ),
            33 => 
            array (
                'id' => 59,
                'name' => 'index',
                'display_name' => 'Index Function Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            34 => 
            array (
                'id' => 60,
                'name' => 'getData',
                'display_name' => 'Get Data Function Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            35 => 
            array (
                'id' => 61,
                'name' => 'store',
                'display_name' => 'Store Function Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            36 => 
            array (
                'id' => 62,
                'name' => 'edit',
                'display_name' => 'Edit Function Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            37 => 
            array (
                'id' => 63,
                'name' => 'searchData',
                'display_name' => 'Search Function Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            38 => 
            array (
                'id' => 64,
                'name' => 'delete',
                'display_name' => 'Delete Function Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
                'system_controller_id' => 6,
                'description' => NULL,
            ),
            39 => 
            array (
                'id' => 65,
                'name' => 'index',
                'display_name' => 'Index Controller Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 7,
                'description' => NULL,
            ),
            40 => 
            array (
                'id' => 66,
                'name' => 'getData',
                'display_name' => 'Get Data Controller Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 7,
                'description' => NULL,
            ),
            41 => 
            array (
                'id' => 67,
                'name' => 'store',
                'display_name' => 'Store Controller Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 7,
                'description' => NULL,
            ),
            42 => 
            array (
                'id' => 68,
                'name' => 'edit',
                'display_name' => 'Edit Controller Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 7,
                'description' => NULL,
            ),
            43 => 
            array (
                'id' => 69,
                'name' => 'delete',
                'display_name' => 'Delete Controller Manager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
                'system_controller_id' => 7,
                'description' => NULL,
            ),
            44 => 
            array (
                'id' => 70,
                'name' => 'index',
                'display_name' => 'Index Privilege Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 10,
                'description' => NULL,
            ),
            45 => 
            array (
                'id' => 71,
                'name' => 'getData',
                'display_name' => 'Get Data Privilege Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 10,
                'description' => NULL,
            ),
            46 => 
            array (
                'id' => 72,
                'name' => 'store',
                'display_name' => 'Store Privilege Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 10,
                'description' => NULL,
            ),
            47 => 
            array (
                'id' => 73,
                'name' => 'edit',
                'display_name' => 'Edit Privilege Manager',
                'created_at' => '2016-07-29 22:18:53',
                'updated_at' => '2016-07-29 22:18:54',
                'created_by' => 1,
                'system_controller_id' => 10,
                'description' => NULL,
            ),
        ));
        
        
    }
}