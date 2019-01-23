<?php

use Illuminate\Database\Seeder;

class NucleosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nucleos')->delete();
        
        \DB::table('nucleos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Nucleo 1',
                'cidade' => 'São Leopoldo',
                'bairro' => 'DUQUE DE CAXIAS',
                'rua' => 'Rua das Panteras',
                'numero_endereco' => '785',
                'cep' => '45.687-987',
                'inativo' => 1,
                'descricao' => NULL,
                'created_at' => '2019-01-22 15:55:39',
                'updated_at' => '2019-01-22 15:55:39',
            ),
        ));
        
        
    }
}