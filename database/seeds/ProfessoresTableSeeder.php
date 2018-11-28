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
                'id' => 8,
                'nome' => 'augusto',
                'matricula' => '12313',
                'telefone' => '45654',
                'email' => 'augusto@augusto.com',
                'cpf' => '45654465',
                'rg' => '4645455',
                'user_id' => null,
                'created_at' => '2018-11-23 11:42:34',
                'updated_at' => '2018-11-23 11:42:34',
            ),
            1 => 
            array (
                'id' => 9,
                'nome' => 'Marcos',
                'matricula' => '1231231',
                'telefone' => '(51) 2312-4466',
                'email' => 'marc@marcos.com',
                'cpf' => '456.156.561-82',
                'rg' => '4654561',
                'user_id' => null,
                'created_at' => '2018-11-23 13:13:11',
                'updated_at' => '2018-11-23 13:13:11',
            ),
            2 => 
            array (
                'id' => 10,
                'nome' => 'Renan',
                'matricula' => '46465465',
                'telefone' => '(51) 4606-1614',
                'email' => 'renan@renan.com',
                'cpf' => '446.106.030-84',
                'rg' => '4564654',
                'user_id' => null,
                'created_at' => '2018-11-23 13:13:59',
                'updated_at' => '2018-11-23 13:13:59',
            ),
            3 => 
            array (
                'id' => 11,
                'nome' => 'Yuri',
                'matricula' => '222131',
                'telefone' => '(51) 5410-0200',
                'email' => 'yuri@yuri.com',
                'cpf' => '541.000.000-00',
                'rg' => '45415151',
                'user_id' => null,
                'created_at' => '2018-11-23 13:14:41',
                'updated_at' => '2018-11-23 13:14:41',
            ),
        ));
        
        
    }
}