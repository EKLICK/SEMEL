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
                'nome' => 'Professor Um',
                'nascimento' => '1991-10-16 00:00:00',
                'matricula' => '45318921',
            'telefone' => '(51) 6515-6186',
                'cpf' => '489.789.123-45',
                'rg' => '4898465113',
                'cidade' => 'Novo Hamburgo',
                'bairro' => NULL,
                'rua' => 'Rua de Novo Hamburgo',
                'numero_endereco' => '762',
                'complemento' => NULL,
                'cep' => '74.897-256',
                'curso' => 'Curso 1',
                'formacao' => 'Formação 1',
                'cref' => 'CREF 1',
                'user_id' => 2,
                'created_at' => '2019-02-12 12:44:50',
                'updated_at' => '2019-02-12 12:44:50',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Professor Dois',
                'nascimento' => '1988-07-21 00:00:00',
                'matricula' => '54649875',
            'telefone' => '(51) 6568-7953',
                'cpf' => '465.798.426-57',
                'rg' => '546549982',
                'cidade' => 'São Leopoldo',
                'bairro' => 'CAMPESTRE',
                'rua' => 'Rua numero um Campestre',
                'numero_endereco' => '456',
                'complemento' => NULL,
                'cep' => '45.646-879',
                'curso' => 'Curso 2',
                'formacao' => 'Formação 2',
                'cref' => 'CREF 2',
                'user_id' => 3,
                'created_at' => '2019-02-12 13:05:15',
                'updated_at' => '2019-02-12 13:05:15',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Professor Três',
                'nascimento' => '1990-09-13 00:00:00',
                'matricula' => '13548985',
            'telefone' => '(51) 6873-0608',
                'cpf' => '700.988.975-68',
                'rg' => '08940985',
                'cidade' => 'Canoas',
                'bairro' => NULL,
                'rua' => 'Rua de Canoas',
                'numero_endereco' => '987',
                'complemento' => NULL,
                'cep' => '65.719-878',
                'curso' => 'Curso 3',
                'formacao' => 'Formação 3',
                'cref' => 'CREF 3',
                'user_id' => 4,
                'created_at' => '2019-02-12 13:11:42',
                'updated_at' => '2019-02-12 13:11:42',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Professor Quatro',
                'nascimento' => '1992-06-16 00:00:00',
                'matricula' => '49878423',
            'telefone' => '(51) 6489-7865',
                'cpf' => '909.007.889-77',
                'rg' => '6179781868',
                'cidade' => 'São Leopoldo',
                'bairro' => 'ARROIO DA MANTEIGA',
                'rua' => 'Rua numero um do arroio da manteiga',
                'numero_endereco' => '519',
                'complemento' => 'Bloco 2',
                'cep' => '46.544-648',
                'curso' => 'Curso 4',
                'formacao' => 'Formação 4',
                'cref' => 'CREF 3',
                'user_id' => 5,
                'created_at' => '2019-02-12 13:28:42',
                'updated_at' => '2019-02-12 13:28:42',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Professor Cinco',
                'nascimento' => '2019-02-12 00:00:00',
                'matricula' => '16512312',
            'telefone' => '(51) 6516-8798',
                'cpf' => '498.732.215-98',
                'rg' => '51651236',
                'cidade' => 'São Leopoldo',
                'bairro' => 'JARDIM AMERICA',
                'rua' => 'Rua numero um Jardim America',
                'numero_endereco' => '168',
                'complemento' => NULL,
                'cep' => '46.546-549',
                'curso' => 'Curso 5',
                'formacao' => 'Formação 5',
                'cref' => 'CREF 5',
                'user_id' => 6,
                'created_at' => '2019-02-13 09:48:25',
                'updated_at' => '2019-02-13 14:14:01',
            ),
        ));
        
        
    }
}