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
        

        \DB::table('Anamneses_doencas')->delete();
        
        \DB::table('Anamneses_doencas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'anamnese_id' => NULL,
                'doenca_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'anamnese_id' => 3,
                'doenca_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'anamnese_id' => 4,
                'doenca_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'anamnese_id' => 8,
                'doenca_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'anamnese_id' => 9,
                'doenca_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'anamnese_id' => 12,
                'doenca_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'anamnese_id' => 14,
                'doenca_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'anamnese_id' => 17,
                'doenca_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'anamnese_id' => 21,
                'doenca_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'anamnese_id' => 23,
                'doenca_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'anamnese_id' => 25,
                'doenca_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'anamnese_id' => 26,
                'doenca_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'anamnese_id' => 28,
                'doenca_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}