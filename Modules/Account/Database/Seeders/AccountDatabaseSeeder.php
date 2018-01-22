<?php

namespace Modules\Account\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        $this->call(RoleTableSeeder::class);
        $this->call(SystemTableSeeder::class);
        $this->call(MenuGroupTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PrivilegeTableSeeder::class);
        $this->call(RolePrivilegeTableSeeder::class);
        $this->call(SystemControllerTableSeeder::class);
        $this->call(SystemFunctionTableSeeder::class);
        $this->call(PrivilegeFunctionTableSeeder::class);
        
        // $this->call("OthersTableSeeder");
    }
}
