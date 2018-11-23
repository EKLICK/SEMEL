<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'admin_professor' => 0,
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$gHwPurQpJSBP.nz4Ba2X3.ZIO/M/xJSj7MSdScE0Fysk1Kwv5sW3m',
                'remember_token' => NULL,
                'created_at' => '2018-11-23 10:31:34',
                'updated_at' => '2018-11-23 10:31:34',
            ),
        ));
        
        
    }
}