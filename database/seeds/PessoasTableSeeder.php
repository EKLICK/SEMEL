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
                'foto' => 'img/img_3x4/imagem_3888.png',
                'nome' => 'Julio da Silva',
                'nascimento' => '1994-04-07 00:00:00',
                'rg' => '51235121',
                'cpf' => '156.156.045-46',
                'cpf_responsavel' => NULL,
                'cidade' => 'São Leopoldo',
                'bairro' => 'Bairro das Flores',
                'rua' => 'Rua das Aráras',
                'numero_endereco' => '620',
                'cep' => '41.981-210',
            'telefone' => '(56) 0980-1565',
            'telefone_emergencia' => '(56) 0198-1210',
                'nome_do_pai' => 'Juliano da Silva',
                'nome_da_mae' => 'Juliana da Silva',
            'pessoa_emergencia' => 'Julia da Silva (irmã)',
                'convenio_medico' => 'SEN',
                'filhos' => 0,
                'irmaos' => 0,
                'sexo' => 'M',
                'estado_civil' => 'Solteiro',
                'matricula' => NULL,
                'mora_com_os_pais' => 2,
                'inativo' => NULL,
                'estado' => 1,
                'created_at' => '2018-12-26 15:25:07',
                'updated_at' => '2018-12-26 15:50:53',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}