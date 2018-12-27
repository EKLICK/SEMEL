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
                'possui_doenca' => 2,
                'toma_medicacao' => 1,
                'alergia_medicacao' => 2,
                'peso' => 83.0,
                'altura' => 1.73,
                'fumante' => 2,
                'cirurgia' => 1,
                'dor_muscular' => 2,
                'dor_ossea' => 2,
                'dor_articular' => 2,
                'atestado' => 2,
                'observacao' => NULL,
                'ano' => 2018,
                'pessoas_id' => 1,
                'created_at' => '2018-12-26 15:25:07',
                'updated_at' => '2018-12-26 15:25:07',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}