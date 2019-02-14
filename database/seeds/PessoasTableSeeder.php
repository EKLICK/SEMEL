<?php

use Illuminate\Database\Seeder;

class PessoasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pessoas')->delete();
        
        \DB::table('pessoas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'foto' => 'img/img_3x4/imagem_5670.png',
                'nome' => 'João Almeida',
                'nascimento' => '1994-08-17 00:00:00',
                'rg' => '871354981',
                'rg_responsavel' => NULL,
                'cpf' => '498.798.498-49',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'FEITORIA',
                'rua' => 'Primeira rua da FEITORIA',
                'numero_endereco' => '465',
                'complemento' => 'Bloco 4',
                'cep' => '41.657-898',
            'telefone' => '(51) 5161-5689',
            'telefone_emergencia' => '(51) 6516-8765',
                'nome_do_pai' => 'Bruno almeida',
                'nome_da_mae' => 'Rita Almeida',
                'pessoa_emergencia' => 'Augusto Almeida',
                'convenio_medico' => 'SON',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'estado' => 1,
                'created_at' => '2019-02-11 15:31:32',
                'updated_at' => '2019-02-11 15:45:31',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'foto' => 'img/img_3x4/imagem_3954.png',
                'nome' => 'Felipe da Silva Soares',
                'nascimento' => '2005-06-08 00:00:00',
                'rg' => '1231465489',
                'rg_responsavel' => '1231321312335',
                'cpf' => '489.321.087-56',
                'cpf_responsavel' => '489.489.454-68',
                'cidade' => 'São Leopoldo',
                'bairro' => 'FEITORIA',
                'rua' => 'Rua numero um Feitoria',
                'numero_endereco' => '788',
                'complemento' => NULL,
                'cep' => '46.549-878',
            'telefone' => '(51) 6165-8792',
            'telefone_emergencia' => '(51) 5616-8795',
                'nome_do_pai' => 'Gustavo da Silva Soares',
                'nome_da_mae' => 'Ana da Silva Soares',
            'pessoa_emergencia' => 'Julio da Silva Soares (irmão)',
                'convenio_medico' => 'OM',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => 'img/img_matricula/imagem_7983.jpeg',
                'mora_com_os_pais' => 1,
                'estado' => 1,
                'created_at' => '2019-02-13 10:06:56',
                'updated_at' => '2019-02-13 12:38:19',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}