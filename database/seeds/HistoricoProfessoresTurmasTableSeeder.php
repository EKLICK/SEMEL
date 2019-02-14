<?php

use Illuminate\Database\Seeder;

class HistoricoProfessoresTurmasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('historico_professores_turmas')->delete();
        
        \DB::table('historico_professores_turmas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'turma_id' => 1,
                'professor_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:50:19',
                'updated_at' => '2019-02-13 09:50:19',
            ),
            1 => 
            array (
                'id' => 2,
                'turma_id' => 2,
                'professor_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:50:26',
                'updated_at' => '2019-02-13 09:50:26',
            ),
            2 => 
            array (
                'id' => 3,
                'turma_id' => 3,
                'professor_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:58:43',
                'updated_at' => '2019-02-13 09:58:43',
            ),
            3 => 
            array (
                'id' => 4,
                'turma_id' => 4,
                'professor_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:58:46',
                'updated_at' => '2019-02-13 09:58:46',
            ),
            4 => 
            array (
                'id' => 5,
                'turma_id' => 5,
                'professor_id' => 3,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:58:55',
                'updated_at' => '2019-02-13 09:58:55',
            ),
            5 => 
            array (
                'id' => 6,
                'turma_id' => 6,
                'professor_id' => 3,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:58:58',
                'updated_at' => '2019-02-13 09:58:58',
            ),
            6 => 
            array (
                'id' => 7,
                'turma_id' => 1,
                'professor_id' => 4,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:59:17',
                'updated_at' => '2019-02-13 09:59:17',
            ),
            7 => 
            array (
                'id' => 8,
                'turma_id' => 2,
                'professor_id' => 4,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:59:20',
                'updated_at' => '2019-02-13 09:59:20',
            ),
            8 => 
            array (
                'id' => 9,
                'turma_id' => 4,
                'professor_id' => 5,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:59:29',
                'updated_at' => '2019-02-13 09:59:29',
            ),
            9 => 
            array (
                'id' => 10,
                'turma_id' => 7,
                'professor_id' => 5,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 09:59:32',
                'updated_at' => '2019-02-13 09:59:32',
            ),
        ));
        
        
    }
}