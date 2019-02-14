<?php

use Illuminate\Database\Seeder;

class HistoricoPessoasTurmasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('historico_pessoas_turmas')->delete();
        
        \DB::table('historico_pessoas_turmas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'turma_id' => 1,
                'pessoa_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-11 15:32:23',
                'updated_at' => '2019-02-11 15:32:23',
            ),
            1 => 
            array (
                'id' => 2,
                'turma_id' => 2,
                'pessoa_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-11 15:32:26',
                'updated_at' => '2019-02-11 15:32:26',
            ),
            2 => 
            array (
                'id' => 3,
                'turma_id' => 2,
                'pessoa_id' => 1,
                'inativo' => 2,
                'comentario' => 'iuhuih',
                'created_at' => '2019-02-13 11:57:37',
                'updated_at' => '2019-02-13 11:57:37',
            ),
            3 => 
            array (
                'id' => 4,
                'turma_id' => 3,
                'pessoa_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 11:59:08',
                'updated_at' => '2019-02-13 11:59:08',
            ),
            4 => 
            array (
                'id' => 5,
                'turma_id' => 3,
                'pessoa_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 14:31:55',
                'updated_at' => '2019-02-13 14:31:55',
            ),
            5 => 
            array (
                'id' => 6,
                'turma_id' => 4,
                'pessoa_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 14:31:59',
                'updated_at' => '2019-02-13 14:31:59',
            ),
            6 => 
            array (
                'id' => 7,
                'turma_id' => 7,
                'pessoa_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 14:32:16',
                'updated_at' => '2019-02-13 14:32:16',
            ),
        ));
        
        
    }
}