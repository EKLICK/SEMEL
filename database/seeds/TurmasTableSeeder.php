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
                'nome' => 'Turma de Basquete A1',
                'limite' => '10',
                'data_semanal' => 'Segunda,Sexta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2018-12-26 15:31:20',
                'updated_at' => '2018-12-28 15:28:38',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Turma de Futebol A1',
                'limite' => '8',
                'data_semanal' => 'Terça,Quinta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2018-12-26 15:32:28',
                'updated_at' => '2018-12-26 15:32:28',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Turma de Ginastica A1',
                'limite' => '10',
                'data_semanal' => 'Domingo,Sabado,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 4,
                'created_at' => '2018-12-26 15:33:24',
                'updated_at' => '2018-12-28 15:47:47',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Turma de Basquete A2',
                'limite' => '10',
                'data_semanal' => 'Segunda,Quinta,',
                'horario_inicial' => '15:00:00',
                'horario_final' => '18:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 2,
                'created_at' => '2018-12-26 15:35:39',
                'updated_at' => '2018-12-27 13:48:46',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Turma de Futebol A2',
                'limite' => '8',
                'data_semanal' => 'Domingo,Sabado,',
                'horario_inicial' => '15:00:00',
                'horario_final' => '18:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 2,
                'created_at' => '2018-12-26 15:36:31',
                'updated_at' => '2018-12-27 13:49:52',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Turma de Ginastica A2',
                'limite' => '10',
                'data_semanal' => 'Segunda,Sexta,',
                'horario_inicial' => '15:00:00',
                'horario_final' => '18:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 4,
                'created_at' => '2018-12-26 15:37:13',
                'updated_at' => '2018-12-28 15:47:53',
            ),
        ));
        
        
    }
}