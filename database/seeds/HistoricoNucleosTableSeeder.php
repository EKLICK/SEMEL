<?php

use Illuminate\Database\Seeder;

class HistoricoNucleosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('historico_nucleos')->delete();
        
        \DB::table('historico_nucleos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nucleo_id' => 1,
                'inativo' => 2,
                'comentario' => '1221332',
                'created_at' => '2019-02-13 11:29:03',
                'updated_at' => '2019-02-13 11:29:03',
            ),
            1 => 
            array (
                'id' => 2,
                'nucleo_id' => 1,
                'inativo' => 1,
                'comentario' => NULL,
                'created_at' => '2019-02-13 14:32:35',
                'updated_at' => '2019-02-13 14:32:35',
            ),
        ));
        
        
    }
}