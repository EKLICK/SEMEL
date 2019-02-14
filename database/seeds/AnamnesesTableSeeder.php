<?php

use Illuminate\Database\Seeder;

class AnamnesesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('anamneses')->delete();
        
        \DB::table('anamneses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'possui_doenca' => 1,
                'toma_medicacao' => NULL,
                'alergia_medicacao' => '-1',
                'peso' => 0.0,
                'altura' => 1.79,
                'fumante' => '2',
                'cirurgia' => 'Perna direita',
                'dor_muscular' => '-1',
                'dor_ossea' => '-1',
                'dor_articular' => 'Mão esquerda',
                'atestado' => '2',
                'observacao' => NULL,
                'ano' => 2019,
                'pessoas_id' => 1,
                'created_at' => '2019-02-11 15:31:32',
                'updated_at' => '2019-02-14 09:47:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'possui_doenca' => 2,
                'toma_medicacao' => 'Medicamento 1',
                'alergia_medicacao' => 'Alergia 1',
                'peso' => 65.0,
                'altura' => 1.69,
                'fumante' => '2',
                'cirurgia' => '-1',
                'dor_muscular' => '-1',
                'dor_ossea' => '-1',
                'dor_articular' => 'Punho esquerdo',
                'atestado' => '2',
                'observacao' => NULL,
                'ano' => 2018,
                'pessoas_id' => 2,
                'created_at' => '2019-02-13 10:06:56',
                'updated_at' => '2019-02-13 10:06:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}