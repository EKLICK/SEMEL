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
                'id' => 1,
                'nome' => 'Leandro',
                'matricula' => '1231621',
            'telefone' => '(51) 4848-3843',
                'email' => 'leandro@leandro.com',
                'cpf' => '561.320.030-02',
                'rg' => '44654645',
                'user_id' => NULL,
                'created_at' => '2018-11-21 12:28:23',
                'updated_at' => '2018-11-21 12:28:23',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Marcos',
                'matricula' => '654456546',
            'telefone' => '(51) 3284-3283',
                'email' => 'marcos@marcos.com',
                'cpf' => '798.787.798-50',
                'rg' => '4651511',
                'user_id' => NULL,
                'created_at' => '2018-11-21 12:29:13',
                'updated_at' => '2018-11-21 12:29:13',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Max',
                'matricula' => '88787987',
            'telefone' => '(51) 3289-2389',
                'email' => 'max@max.com',
                'cpf' => '456.879.894-11',
                'rg' => '4545468',
                'user_id' => NULL,
                'created_at' => '2018-11-21 12:29:57',
                'updated_at' => '2018-11-21 12:29:57',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Diego',
                'matricula' => '787979',
            'telefone' => '(51) 3543-3295',
                'email' => 'diego@diego.com',
                'cpf' => '777.777.777-77',
                'rg' => '4564654',
                'user_id' => NULL,
                'created_at' => '2018-11-21 12:30:36',
                'updated_at' => '2018-11-21 12:30:36',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Rafaél',
                'matricula' => '8797848',
            'telefone' => '(51) 3283-9929',
                'email' => 'refael@rafarel.com',
                'cpf' => '789.454.789-02',
                'rg' => '77897987',
                'user_id' => NULL,
                'created_at' => '2018-11-21 12:31:32',
                'updated_at' => '2018-11-21 12:31:32',
            ),
        ));
        
        
    }
}