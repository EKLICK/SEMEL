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
                'toma_medicacao' => NULL,
                'alergia_medicacao' => NULL,
                'peso' => NULL,
                'altura' => NULL,
                'fumante' => NULL,
                'cirurgia' => NULL,
                'dor_muscular' => NULL,
                'dor_ossea' => NULL,
                'dor_articular' => NULL,
                'atestado' => 2,
                'observacao' => NULL,
                'ano' => 2019,
                'pessoas_id' => 2,
                'created_at' => '2019-01-24 10:46:26',
                'updated_at' => '2019-01-24 10:46:26',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}