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
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$FJwlh1MG8wxQT19901RDS.VdQSdIV2.oR1BVy9wTofexOXANX8ZUC',
                'remember_token' => NULL,
                'created_at' => '2018-11-21 10:57:29',
                'updated_at' => '2018-11-21 10:57:29',
            ),
        ));
        
        
    }
}