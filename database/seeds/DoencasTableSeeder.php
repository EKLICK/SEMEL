<?php

use Illuminate\Database\Seeder;

class DoencasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('doencas')->delete();
        
        \DB::table('doencas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Acne',
                'descricao' => 'Sensível ao sol.',
                'created_at' => '2018-12-26 15:38:19',
                'updated_at' => '2018-12-26 15:38:19',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Gripe',
                'descricao' => 'Contagiante, problemas respiratórios.',
                'created_at' => '2018-12-26 15:38:45',
                'updated_at' => '2018-12-26 15:40:15',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Tosse',
                'descricao' => 'Problemas respiratórios, dor de garganta.',
                'created_at' => '2018-12-26 15:39:06',
                'updated_at' => '2018-12-26 15:40:21',
            ),
            3 => 
            array (
                'id' => 5,
                'nome' => 'Alergia de Pele',
                'descricao' => 'Sensível ao sol, problemas de alergia.',
                'created_at' => '2018-12-26 15:57:31',
                'updated_at' => '2018-12-26 15:58:19',
            ),
            4 => 
            array (
                'id' => 6,
                'nome' => 'Insônia',
                'descricao' => 'Cansaço, problemas de resistência, fadiga.',
                'created_at' => '2018-12-26 15:58:15',
                'updated_at' => '2018-12-26 15:58:15',
            ),
        ));
        
        
    }
}