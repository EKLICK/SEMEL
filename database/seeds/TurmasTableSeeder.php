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
                'limite' => '8',
                'quant_atual' => '1',
                'data_semanal' => 'Segunda,Quinta,',
                'horario_inicial' => '24:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-02-11 14:01:53',
                'updated_at' => '2019-02-11 14:01:53',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Turma de Basquete A2',
                'limite' => '8',
                'quant_atual' => '0',
                'data_semanal' => 'Quinta,Sexta,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 2,
                'created_at' => '2019-02-11 14:13:20',
                'updated_at' => '2019-02-13 10:22:11',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Turma de Futebol A1',
                'limite' => '8',
                'quant_atual' => '2',
                'data_semanal' => 'Domingo,Sabado,',
                'horario_inicial' => '12:00:00',
                'horario_final' => '14:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 4,
                'created_at' => '2019-02-11 14:14:34',
                'updated_at' => '2019-02-11 14:14:34',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Turma de Futebol A2',
                'limite' => '8',
                'quant_atual' => '1',
                'data_semanal' => 'Quinta,Sexta,',
                'horario_inicial' => '15:00:00',
                'horario_final' => '18:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 2,
                'created_at' => '2019-02-11 14:15:48',
                'updated_at' => '2019-02-11 14:15:48',
            ),
            4 => 
            array (
                'id' => 5,
                'nome' => 'Turma de Ginastica A1',
                'limite' => '5',
                'quant_atual' => '0',
                'data_semanal' => 'Terça,Sexta,',
                'horario_inicial' => '18:00:00',
                'horario_final' => '20:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 3,
                'created_at' => '2019-02-11 14:16:54',
                'updated_at' => '2019-02-13 10:22:19',
            ),
            5 => 
            array (
                'id' => 6,
                'nome' => 'Turma de Ginastica A2',
                'limite' => '8',
                'quant_atual' => '0',
                'data_semanal' => 'Quinta,Sexta,',
                'horario_inicial' => '17:00:00',
                'horario_final' => '19:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 3,
                'created_at' => '2019-02-11 15:13:13',
                'updated_at' => '2019-02-11 15:13:35',
            ),
            6 => 
            array (
                'id' => 7,
                'nome' => 'Turma de Futebol A3',
                'limite' => '8',
                'quant_atual' => '1',
                'data_semanal' => 'Segunda,Terça,',
                'horario_inicial' => '20:00:00',
                'horario_final' => '22:00:00',
                'inativo' => 1,
                'descricao' => NULL,
                'nucleo_id' => 1,
                'created_at' => '2019-02-11 15:17:46',
                'updated_at' => '2019-02-11 15:17:46',
            ),
        ));
        
        
    }
}