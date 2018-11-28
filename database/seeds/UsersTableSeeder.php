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
                'remember_token' => 'knMUmmjxRciYk6H0VtLInj01RciqRnjkyU2uo8EB5cV5prC94spcwJcYogXm',
                'created_at' => '2018-11-27 15:58:41',
                'updated_at' => '2018-11-27 15:58:41',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Renan',
                'admin_professor' => 0,
                'email' => 'renan@renan.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$jEW2HrSIXhAim35XNEXXtOOvkbr4wR6BkgPD9GhpYggkQ.2mjROmq',
                'remember_token' => NULL,
                'created_at' => '2018-11-28 11:14:59',
                'updated_at' => '2018-11-28 11:14:59',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Augusto',
                'admin_professor' => 0,
                'email' => 'augusto@augusto.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$UXhM1qniS2VdmNrvHMO9hemxuA5Dn.h7jmHN8Gp4jQ9.ZhVJML9pS',
                'remember_token' => NULL,
                'created_at' => '2018-11-28 11:15:37',
                'updated_at' => '2018-11-28 11:15:37',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Yuri',
                'admin_professor' => 0,
                'email' => 'yuri@yuri.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$FNLvQorcrUkYwBemKQiAv.XLd9iTFk/xJ8XCOTGXD/zNDZl5Jn8t.',
                'remember_token' => NULL,
                'created_at' => '2018-11-28 11:16:12',
                'updated_at' => '2018-11-28 11:16:12',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Maicon',
                'admin_professor' => 0,
                'email' => 'maicon',
                'email_verified_at' => NULL,
                'password' => '$2y$10$uXhmvuH583ZTNg8WwO.0jethpSfS1xrAn7iUeS65pNbLw2./bH82O',
                'remember_token' => NULL,
                'created_at' => '2018-11-28 11:16:50',
                'updated_at' => '2018-11-28 11:16:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}