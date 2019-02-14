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
                'bairro' => 'CRISTO REI',
                'rua' => 'Ruas das Aráras',
                'numero_endereco' => '523',
                'cep' => '45.565-892',
                'inativo' => 1,
                'descricao' => 'Comentário exemplo do núcleo Leste',
                'created_at' => '2019-02-11 13:56:02',
                'updated_at' => '2019-02-13 14:32:35',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Núcleo Norte',
                'cidade' => 'São Leopoldo',
                'bairro' => 'FAZENDA SAO BORJA',
                'rua' => 'Rua dos Elefantes',
                'numero_endereco' => '898',
                'cep' => '56.548-988',
                'inativo' => 1,
                'descricao' => 'Comentário exemplo do núcleo Norte',
                'created_at' => '2019-02-11 13:57:14',
                'updated_at' => '2019-02-11 14:10:31',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Núcleo Oeste',
                'cidade' => 'São Leopoldo',
                'bairro' => 'CENTRO',
                'rua' => 'Rua das Gaivotas',
                'numero_endereco' => '985',
                'cep' => '87.945-687',
                'inativo' => 1,
                'descricao' => 'Comentário exemplo do núcleo Oeste.',
                'created_at' => '2019-02-11 13:58:55',
                'updated_at' => '2019-02-11 13:58:55',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Núcleo Sul',
                'cidade' => 'São Leopoldo',
                'bairro' => 'BOA VISTA',
                'rua' => 'Rua das Panteras',
                'numero_endereco' => '468',
                'cep' => '46.589-223',
                'inativo' => 1,
                'descricao' => 'Comentário exemplo do núcleo Sul.',
                'created_at' => '2019-02-11 14:00:03',
                'updated_at' => '2019-02-14 11:38:56',
            ),
        ));
        
        
    }
}