<?php
namespace Modules\Account\Database\Seeders;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user')->delete();
        
        \DB::table('user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'is_active' => 1,
                'name' => 'admin',
                'email' => 'admin@facile.com',
                'password' => '$2y$10$Llk9CHGZDvw0op1iTu6CaOWG3AREJmJBGBgY2z.ticrfwu1TaTi0C',
                'remember_token' => 'HfZHieuAQAFD2b0jx8ZF5pfecUi5EfYZoKBSMxtU9Y1NUWDbbZLJETO6eBhl',
                'created_at' => '2016-07-29 18:12:15',
                'updated_at' => '2016-09-16 16:27:27',
                'created_by' => 1,
            ),
        ));
        
        
    }
}