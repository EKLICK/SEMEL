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
                'limite' => '4',
                'quant_atual' => '0',
                'data_semanal' => 'Sexta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '12:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-24 10:37:26',
                'updated_at' => '2019-01-24 10:37:26',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Turma 2',
                'limite' => '2',
                'quant_atual' => '0',
                'data_semanal' => 'Domingo,Quarta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '12:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-24 10:42:45',
                'updated_at' => '2019-01-24 10:42:45',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Turma 3',
                'limite' => '1',
                'quant_atual' => '0',
                'data_semanal' => 'Quarta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '12:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-01-24 10:43:11',
                'updated_at' => '2019-01-24 10:43:11',
            ),
        ));
        
        
    }
}