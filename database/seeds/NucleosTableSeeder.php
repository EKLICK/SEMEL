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
                'nome' => 'Núcleo Leste',
                'cidade' => 'São Leopoldo',
                'bairro_id' => 5,
                'rua' => 'Rua dos Elefantes',
                'numero_endereco' => '250',
                'cep' => '15.615-089',
                'inativo' => 2,
                'descricao' => 'bairro_id_id ao leste da cidade',
                'created_at' => '2018-12-26 15:25:52',
                'updated_at' => '2018-12-27 13:43:59',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Núcleo Norte',
                'cidade' => 'São Leopoldo',
                'bairro_id' => 20,
                'rua' => 'Rua das Girafas',
                'numero_endereco' => '894',
                'cep' => '15.651-891',
                'inativo' => 1,
                'descricao' => 'bairro_id_id ao norte da cidade',
                'created_at' => '2018-12-26 15:26:39',
                'updated_at' => '2018-12-26 15:26:39',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Núcleo Oeste',
                'cidade' => 'São Leopoldo',
                'bairro_id' => 5,
                'rua' => 'Rua dos Macacos',
                'numero_endereco' => '451',
                'cep' => '50.560-564',
                'inativo' => 1,
                'descricao' => 'bairro_id_id ao oeste da cidade',
                'created_at' => '2018-12-26 15:27:23',
                'updated_at' => '2018-12-26 15:27:23',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Núcleo Sul',
                'cidade' => 'São Leopoldo',
                'bairro_id' => 6,
                'rua' => 'Rua das onças',
                'numero_endereco' => '516',
                'cep' => '15.061-888',
                'inativo' => 1,
                'descricao' => 'bairro_id ao sul da cidade',
                'created_at' => '2018-12-26 15:28:13',
                'updated_at' => '2018-12-26 15:28:13',
            ),
        ));
        
        
    }
}