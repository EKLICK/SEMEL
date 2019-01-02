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
                'nome' => 'Yuri',
                'nascimento' => '1989-03-08 00:00:00',
                'matricula' => '14551565',
            'telefone' => '(51) 1650-1651',
                'cpf' => '560.859.601-51',
                'rg' => '51601809',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro dos armários',
                'rua' => 'Rua das Panteras',
                'numero_endereco' => '251',
                'cep' => '56.561-810',
                'curso' => 'Curso em Futebol',
                'formacao' => 'Formação em educação física',
                'user_id' => 2,
                'created_at' => '2018-12-26 15:45:38',
                'updated_at' => '2018-12-26 15:45:38',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Oscar',
                'nascimento' => '1991-08-14 00:00:00',
                'matricula' => '1561851',
            'telefone' => '(18) 9480-8941',
                'cpf' => '618.908.503-27',
                'rg' => '18941561',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Ruas das Aráras',
                'numero_endereco' => '098',
                'cep' => '15.156-515',
                'curso' => 'Curso em Ginastica',
                'formacao' => 'Formação em educação física',
                'user_id' => 3,
                'created_at' => '2018-12-26 15:47:39',
                'updated_at' => '2018-12-26 15:47:39',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Fernando',
                'nascimento' => '1983-11-16 00:00:00',
                'matricula' => '1864651',
            'telefone' => '(16) 5108-5749',
                'cpf' => '864.018.412-62',
                'rg' => '15616581',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua dos Cachorros',
                'numero_endereco' => '262',
                'cep' => '56.165-051',
                'curso' => 'Curso em Basquete',
                'formacao' => 'Formação em educação física',
                'user_id' => 4,
                'created_at' => '2018-12-26 15:50:06',
                'updated_at' => '2018-12-26 15:50:06',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Mario',
                'nascimento' => '1981-02-04 00:00:00',
                'matricula' => '2165150',
            'telefone' => '(18) 9618-0665',
                'cpf' => '486.100.894-51',
                'rg' => '4896012',
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Comidas',
                'rua' => 'Rua das Gaivotas',
                'numero_endereco' => '518',
                'cep' => '15.156-112',
                'curso' => 'Curso de Basquete',
                'formacao' => 'Formação em educação física',
                'user_id' => 5,
                'created_at' => '2018-12-26 15:54:40',
                'updated_at' => '2018-12-26 15:54:40',
            ),
        ));
        
        
    }
}