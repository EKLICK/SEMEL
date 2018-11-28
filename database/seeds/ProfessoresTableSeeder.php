<?php

use Illuminate\Database\Seeder;

class ProfessoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('professores')->delete();
        
        \DB::table('professores')->insert(array (
            0 => 
            array (
                'id' => 12,
                'nome' => 'Renan',
                'matricula' => '1313123213',
            'telefone' => '(51)  15351-5135',
                'email' => 'renan@renan.com',
                'cpf' => '513.132.312-78',
                'rg' => '5644564156',
                'user_id' => 2,
                'created_at' => '2018-11-28 11:15:00',
                'updated_at' => '2018-11-28 11:15:00',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 13,
                'nome' => 'Augusto',
                'matricula' => '54645645646',
            'telefone' => '(51)  1351-5135',
                'email' => 'augusto@augusto.com',
                'cpf' => '546.089.170-98',
                'rg' => '65445646',
                'user_id' => 3,
                'created_at' => '2018-11-28 11:15:37',
                'updated_at' => '2018-11-28 11:15:37',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 14,
                'nome' => 'Yuri',
                'matricula' => '54656016056',
            'telefone' => '(51) 5555-5555',
                'email' => 'yuri@yuri.com',
                'cpf' => '454.000.000-00',
                'rg' => '645650500',
                'user_id' => 4,
                'created_at' => '2018-11-28 11:16:12',
                'updated_at' => '2018-11-28 11:16:12',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 15,
                'nome' => 'Maicon',
                'matricula' => '40000000',
            'telefone' => '(51) 0000-0000',
                'email' => 'maicon',
                'cpf' => '481.040.000-78',
                'rg' => '4800065156',
                'user_id' => 5,
                'created_at' => '2018-11-28 11:16:50',
                'updated_at' => '2018-11-28 11:16:50',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}