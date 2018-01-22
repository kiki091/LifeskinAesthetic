<?php

namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu')->delete();
        
        \DB::table('menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Role Manager',
                'uri' => 'facile.role.index',
                'order' => 3,
                'menu_group_id' => 2,
                'function_js' => 'rolemanager',
                'created_at' => '2016-07-29 22:26:38',
                'updated_at' => '2017-06-21 10:50:48',
                'created_by' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admin Manager',
                'uri' => 'facile.admin.index',
                'order' => 5,
                'menu_group_id' => 2,
                'function_js' => 'adminmanager',
                'created_at' => '2016-07-29 22:26:38',
                'updated_at' => '2016-07-29 22:26:40',
                'created_by' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Controller Manager',
                'uri' => 'facile.controller.index',
                'order' => 7,
                'menu_group_id' => 2,
                'function_js' => 'controllermanager',
                'created_at' => NULL,
                'updated_at' => '2016-09-27 18:36:01',
                'created_by' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Menu Manager',
                'uri' => 'facile.menu.index',
                'order' => 1,
                'menu_group_id' => 2,
                'function_js' => 'menumanager',
                'created_at' => NULL,
                'updated_at' => '2017-06-21 10:50:42',
                'created_by' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Menu Group Manager',
                'uri' => 'facile.group.index',
                'order' => 2,
                'menu_group_id' => 2,
                'function_js' => 'menugroupmanager',
                'created_at' => NULL,
                'updated_at' => '2017-06-21 10:50:48',
                'created_by' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Privilege Manager',
                'uri' => 'facile.privilege.index',
                'order' => 8,
                'menu_group_id' => 2,
                'function_js' => 'privilegemanager',
                'created_at' => NULL,
                'updated_at' => '2016-09-06 15:41:43',
                'created_by' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Function Manager',
                'uri' => 'facile.function.index',
                'order' => 6,
                'menu_group_id' => 2,
                'function_js' => 'functionmanager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'System Manager',
                'uri' => 'facile.system.index',
                'order' => 9,
                'menu_group_id' => 2,
                'function_js' => 'systemmanager',
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => 1,
            ),
        ));
        
        
    }
}