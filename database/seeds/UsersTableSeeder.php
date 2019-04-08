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
                'admin_professor' => 1,
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$WxCuRbyZGTC93/DyxcE3kuGRIpT2HVJfPQX07IufhKOH7acwL.jNG',
                'remember_token' => 'KKxj9D9BZIwDvSDG9ddlwLGtt1nKSxiVonuzk6EKUK6bu8Gb2LdpjnMs8wEe',
                'created_at' => '2018-11-27 15:58:41',
                'updated_at' => '2018-11-27 15:58:41',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'professorum',
                'admin_professor' => 0,
                'email' => 'professorum@professorum.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/dy51kz48UfcxaVqdb2Q7Oj7ING.WBcbZkGklYocBo4OfKttD3XP.',
                'remember_token' => 'LBAjyfcdAUcEZoZvHTKRilPGawQQKUzFzf2bOsB8AYPmM0fpXduTIay2iIGo',
                'created_at' => '2019-02-12 12:44:50',
                'updated_at' => '2019-02-12 12:44:50',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'professordois',
                'admin_professor' => 0,
                'email' => 'professordois@professordois.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$mxPNgTczDRRo7PTbgCq./OUk73G1gvM/jYgcm0.ceOPsfquik3h6a',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 13:05:15',
                'updated_at' => '2019-02-12 13:05:15',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'professortres',
                'admin_professor' => 0,
                'email' => 'professortres@professortres.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$G5RUX119qbGoRjp5sTTGGOGWqXsym4SBItCbDfEJFCgDWuXcGl3b6',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 13:11:42',
                'updated_at' => '2019-02-12 13:11:42',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'professorquatro',
                'admin_professor' => 0,
                'email' => 'professorquatro@professorquatro.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$kn1CjhLdBIIWNK4FENz67O9SshOwoRcxfW783nsdQzWVLvEW5FT0W',
                'remember_token' => NULL,
                'created_at' => '2019-02-12 13:28:42',
                'updated_at' => '2019-02-12 13:28:42',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'professorcinco',
                'admin_professor' => 0,
                'email' => 'professorcinco@professorcinco.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$X/gY6cgkKrrAAl2WIpRj0e35FHBp.LFGxLE94m3R9FzYpNnhV.5nu',
                'remember_token' => NULL,
                'created_at' => '2019-02-13 09:48:25',
                'updated_at' => '2019-02-13 09:48:25',
                'deleted_at' => NULL,
            ),
        ));
    }
}