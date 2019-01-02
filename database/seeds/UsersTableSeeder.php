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
                'remember_token' => '5MHmFU0d5fNOtNKXGB8HZGUJBE5qAsCaQoDOcXvpPvXVUhWvOeYxtQT75C5j',
                'created_at' => '2018-11-27 15:58:41',
                'updated_at' => '2018-11-27 15:58:41',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'yuri',
                'admin_professor' => 0,
                'email' => 'yuri@yuri.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$vvnoZWd7ykMK6nVtAY.bVOpcmfttXEj/Pu2ofbdew7iJngk1MjmUa',
                'remember_token' => NULL,
                'created_at' => '2018-12-26 15:45:38',
                'updated_at' => '2018-12-26 15:45:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'oscar',
                'admin_professor' => 0,
                'email' => 'oscar@oscar.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/3etdWvPryUp0HLW7iWbY.JzfTmT2lUYqS6NZvMFcb0QVnD2f4ikm',
                'remember_token' => NULL,
                'created_at' => '2018-12-26 15:47:39',
                'updated_at' => '2018-12-26 15:47:39',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'fernando',
                'admin_professor' => 0,
                'email' => 'fernando@fernando.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Ccqhy/KQWaPsefO3L9kxhOkBJDrLG5NWDM.Xv/gCTDSMkdZTx6YHG',
                'remember_token' => NULL,
                'created_at' => '2018-12-26 15:50:06',
                'updated_at' => '2018-12-26 15:50:06',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'mario',
                'admin_professor' => 0,
                'email' => 'mario@mario.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Jtas9u7Oh1fHZbCmIRxD3u5aj.wv6vlmnAn1jY3B8RUEEAQIJ4EJu',
                'remember_token' => 'qeTs0z5ViYthhN8ZJ1IcWyEuGYHoDyqDU8vAKm916G0Oc2sRcf9DjBk94tB7',
                'created_at' => '2018-12-26 15:54:40',
                'updated_at' => '2018-12-26 15:54:40',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}