<?php

use Illuminate\Database\Seeder;

class TurmasPessoasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('turmas_pessoas')->delete();
        
        \DB::table('turmas_pessoas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'turma_id' => 1,
                'pessoa_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'turma_id' => 3,
                'pessoa_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 6,
                'turma_id' => 7,
                'pessoa_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 7,
                'turma_id' => 2,
                'pessoa_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 8,
                'turma_id' => 4,
                'pessoa_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 9,
                'turma_id' => NULL,
                'pessoa_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 10,
                'turma_id' => 2,
                'pessoa_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 11,
                'turma_id' => 7,
                'pessoa_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 13,
                'turma_id' => 3,
                'pessoa_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 14,
                'turma_id' => NULL,
                'pessoa_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 15,
                'turma_id' => 3,
                'pessoa_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 16,
                'turma_id' => NULL,
                'pessoa_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 17,
                'turma_id' => 3,
                'pessoa_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 18,
                'turma_id' => 4,
                'pessoa_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 19,
                'turma_id' => 2,
                'pessoa_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 20,
                'turma_id' => 1,
                'pessoa_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 21,
                'turma_id' => 7,
                'pessoa_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 22,
                'turma_id' => 1,
                'pessoa_id' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}