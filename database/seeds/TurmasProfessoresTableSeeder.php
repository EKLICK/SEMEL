<?php

use Illuminate\Database\Seeder;

class TurmasProfessoresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('turmas_professores')->delete();
        
        \DB::table('turmas_professores')->insert(array (
            0 => 
            array (
                'id' => 1,
                'turma_id' => 1,
                'professor_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'turma_id' => 3,
                'professor_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'turma_id' => 7,
                'professor_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'turma_id' => 1,
                'professor_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'turma_id' => 2,
                'professor_id' => 9,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'turma_id' => 4,
                'professor_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'turma_id' => 2,
                'professor_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'turma_id' => 7,
                'professor_id' => 10,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'turma_id' => 4,
                'professor_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'turma_id' => 3,
                'professor_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}