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
                'nome' => 'Turma 1',
                'limite' => '48',
                'data_semanal' => 'Domingo,Sexta,',
                'horario_inicial' => '24:00:00',
                'horario_final' => '24:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-22 15:56:04',
                'updated_at' => '2019-01-22 15:56:04',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Turma 2',
                'limite' => '15',
                'data_semanal' => 'Quarta,Sexta,',
                'horario_inicial' => '24:00:00',
                'horario_final' => '24:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-22 15:56:25',
                'updated_at' => '2019-01-22 15:56:25',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Turma 3',
                'limite' => '23',
                'data_semanal' => 'Quinta,Sexta,',
                'horario_inicial' => '24:00:00',
                'horario_final' => '24:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-22 15:56:44',
                'updated_at' => '2019-01-22 15:56:44',
            ),
        ));
        
        
    }
}