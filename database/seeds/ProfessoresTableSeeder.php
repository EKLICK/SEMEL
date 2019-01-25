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
                'nome' => 'Professor',
                'nascimento' => '2019-01-02 00:00:00',
                'matricula' => '5646456',
                'telefone' => '(44) 5646-5465',
                'cpf' => '456.456.896-45',
                'rg' => '15615688',
                'cidade' => 'São leopoldo',
                'bairro' => 'Bairro dos Grandes',
                'rua' => 'Ruas das Aráras',
                'numero_endereco' => '456',
                'cep' => '45.649-848',
                'curso' => 'teste',
                'formacao' => 'teste',
                'user_id' => 1,
                'created_at' => '2019-01-25 10:54:24',
                'updated_at' => '2019-01-25 10:54:24',
            ),
        ));
        
        
    }
}