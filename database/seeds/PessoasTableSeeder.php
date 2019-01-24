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
                'id' => 2,
                'foto' => NULL,
                'nome' => 'Pessoa',
                'nascimento' => '2013-03-14 00:00:00',
                'rg' => NULL,
                'cpf' => NULL,
                'cpf_responsavel' => NULL,
                'cidade' => 'São leopoldo',
                'bairro' => NULL,
                'rua' => NULL,
                'numero_endereco' => NULL,
                'cep' => NULL,
                'telefone' => NULL,
                'telefone_emergencia' => NULL,
                'nome_do_pai' => NULL,
                'nome_da_mae' => NULL,
                'pessoa_emergencia' => NULL,
                'convenio_medico' => NULL,
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => NULL,
                'matricula' => NULL,
                'mora_com_os_pais' => NULL,
                'estado' => 0,
                'created_at' => '2019-01-24 10:46:26',
                'updated_at' => '2019-01-24 10:46:26',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}