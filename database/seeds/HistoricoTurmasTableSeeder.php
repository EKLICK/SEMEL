<?php

use Illuminate\Database\Seeder;

class HistoricoTurmasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('historico_turmas')->delete();
        
        \DB::table('historico_turmas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'turma_id' => 2,
                'inativo' => 2,
                'comentario' => 'Chuva intensa',
                'created_at' => '2019-02-13 10:14:47',
                'updated_at' => '2019-02-13 10:14:47',
            ),
            1 => 
            array (
                'id' => 2,
                'turma_id' => 5,
                'inativo' => 2,
                'comentario' => 'Fechamento temporario',
                'created_at' => '2019-02-13 10:15:13',
                'updated_at' => '2019-02-13 10:15:13',
            ),
            2 => 
            array (
                'id' => 3,
                'turma_id' => 2,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 10:22:11',
                'updated_at' => '2019-02-13 10:22:11',
            ),
            3 => 
            array (
                'id' => 4,
                'turma_id' => 5,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 10:22:19',
                'updated_at' => '2019-02-13 10:22:19',
            ),
        ));
        
        
    }
}