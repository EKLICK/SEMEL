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
                'nome' => 'Gripe',
                'descricao' => 'contagiante, imunidade baixa, fraqueaza',
                'created_at' => '2018-11-21 11:02:25',
                'updated_at' => '2018-11-21 11:02:25',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Tosse',
                'descricao' => 'baixa respiração, dores na gargante',
                'created_at' => '2018-11-21 11:03:47',
                'updated_at' => '2018-11-21 11:03:47',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Acne',
                'descricao' => 'Pele sensível',
                'created_at' => '2018-11-21 11:05:33',
                'updated_at' => '2018-11-21 11:05:33',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Virose',
                'descricao' => 'Baixa imunidade, Cansaço,',
                'created_at' => '2018-11-21 11:06:41',
                'updated_at' => '2018-11-21 11:06:41',
            ),
        ));
        
        
    }
}