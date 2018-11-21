<?php

use Illuminate\Database\Seeder;

class TurmasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('turmas')->delete();
        
        \DB::table('turmas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Turma do basquete',
                'limite' => '3',
                'nucleo_id' => 1,
                'created_at' => '2018-11-21 12:34:59',
                'updated_at' => '2018-11-21 12:34:59',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Turma do yoga',
                'limite' => '4',
                'nucleo_id' => 2,
                'created_at' => '2018-11-21 12:35:17',
                'updated_at' => '2018-11-21 12:35:17',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Turma do futebol',
                'limite' => '5',
                'nucleo_id' => 4,
                'created_at' => '2018-11-21 12:35:32',
                'updated_at' => '2018-11-21 12:35:32',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Turma da ginastica',
                'limite' => '2',
                'nucleo_id' => 3,
                'created_at' => '2018-11-21 12:35:49',
                'updated_at' => '2018-11-21 12:35:49',
            ),
            4 => 
            array (
                'id' => 7,
                'nome' => 'Turma do volei',
                'limite' => '4',
                'nucleo_id' => 3,
                'created_at' => '2018-11-21 12:36:44',
                'updated_at' => '2018-11-21 12:36:44',
            ),
        ));
        
        
    }
}