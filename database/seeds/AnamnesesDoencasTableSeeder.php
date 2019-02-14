<?php

use Illuminate\Database\Seeder;

class AnamnesesDoencasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('anamneses_doencas')->delete();
        
        \DB::table('anamneses_doencas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'anamnese_id' => 1,
                'doenca_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'anamnese_id' => 1,
                'doenca_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}