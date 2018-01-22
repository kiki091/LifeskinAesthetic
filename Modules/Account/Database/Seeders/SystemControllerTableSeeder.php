<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SystemControllerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('system_controller')->delete();
        
        \DB::table('system_controller')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\RoleController',
                'display_name' => 'Role Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\AdminController',
                'display_name' => 'Admin Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\SystemFunctionController',
                'display_name' => 'Function Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\ControllerManagerController',
                'display_name' => 'Controller Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\MenuController',
                'display_name' => 'Menu Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\GroupController',
                'display_name' => 'Menu Group Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\PrivilegeController',
                'display_name' => 'Privilege Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'Modules\\Account\\Http\\Controllers\\Admin\\SystemController',
                'display_name' => 'System Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
            ),
        ));
        
        
    }
}