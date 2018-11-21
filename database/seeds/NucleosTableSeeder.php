<?php

use Illuminate\Database\Seeder;

class NucleosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('nucleos')->delete();
        
        \DB::table('nucleos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nome' => 'Núcleo leste',
                'bairro' => 'Girafas',
                'created_at' => '2018-11-21 12:33:29',
                'updated_at' => '2018-11-21 12:33:29',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Núcleo oeste',
                'bairro' => 'Zebras',
                'created_at' => '2018-11-21 12:33:45',
                'updated_at' => '2018-11-21 12:33:45',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Núcleo norte',
                'bairro' => 'Gaivotas',
                'created_at' => '2018-11-21 12:34:27',
                'updated_at' => '2018-11-21 12:34:27',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Núcleo sul',
                'bairro' => 'Linhas',
                'created_at' => '2018-11-21 12:34:44',
                'updated_at' => '2018-11-21 12:34:44',
            ),
        ));
        
        
    }
}