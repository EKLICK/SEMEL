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
                'id' => 7,
                'name' => 'augusto',
                'admin_professor' => 0,
                'email' => 'augusto@augusto.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$iZwbWxA3Q/LI6zUC3dWWJ.hcHQCUss9OUoiOJzsV2k3Z.lMOiTRhO',
                'remember_token' => 'tKIwOtSeE5QKkVKJeeNZPT3BEqWCE4OY8fk0Qj59sNOtth2OhbCIwNcia0ba',
                'created_at' => '2018-11-23 11:42:34',
                'updated_at' => '2018-11-23 11:42:34',
            ),
            1 => 
            array (
                'id' => 8,
                'name' => 'joao',
                'admin_professor' => 1,
                'email' => 'joao@joao.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$iCn7kr627wxBRJP5zkZRB.rZWM9bKF5JCr1aSKjwse7B.Jiba5Noy',
                'remember_token' => 'usmQV9Nx2yJVP7dDQX5YSH7QAKmBmwhPutpb6GLxQtiMaLq5qlaF4FYKCCNo',
                'created_at' => '2018-11-23 11:45:44',
                'updated_at' => '2018-11-23 11:45:44',
            ),
            2 => 
            array (
                'id' => 9,
                'name' => 'admin',
                'admin_professor' => 1,
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ami0PJr.4IT53sk6DgbPTuwhs2ZSknMlk7yKQKAqV7ILmh5eDg0.y',
                'remember_token' => NULL,
                'created_at' => '2018-11-23 13:12:26',
                'updated_at' => '2018-11-23 13:12:26',
            ),
            3 => 
            array (
                'id' => 10,
                'name' => 'Marcos',
                'admin_professor' => 0,
                'email' => 'marc@marcos.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$MeYSssUqjJaX/ifKdRm3yuxiIsrACk9yjVQLLoPeutz8Zh9tl9ZvW',
                'remember_token' => NULL,
                'created_at' => '2018-11-23 13:13:11',
                'updated_at' => '2018-11-23 13:13:11',
            ),
            4 => 
            array (
                'id' => 11,
                'name' => 'Renan',
                'admin_professor' => 0,
                'email' => 'renan@renan.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$YkV2LYsaNoDC7hGvhLSePux/yggvoF8EzyQjECmXhHtk7.K04L8Du',
                'remember_token' => NULL,
                'created_at' => '2018-11-23 13:13:59',
                'updated_at' => '2018-11-23 13:13:59',
            ),
            5 => 
            array (
                'id' => 12,
                'name' => 'Yuri',
                'admin_professor' => 0,
                'email' => 'yuri@yuri.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ga3r3APnhKQNee2ATAkZm.v754UdPubxp5wyoC78kv7UkqpJnkQe2',
                'remember_token' => NULL,
                'created_at' => '2018-11-23 13:14:41',
                'updated_at' => '2018-11-23 13:14:41',
            ),
        ));
        
        
    }
}