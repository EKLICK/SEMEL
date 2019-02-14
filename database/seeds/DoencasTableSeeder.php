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
                'nome' => 'Primeira Doença',
                'descricao' => 'Comentário doença 1',
                'created_at' => '2019-02-11 15:19:20',
                'updated_at' => '2019-02-11 15:19:20',
            ),
            1 => 
            array (
                'id' => 2,
                'nome' => 'Segunda Doença',
                'descricao' => 'Comentário Doença 2',
                'created_at' => '2019-02-11 15:19:33',
                'updated_at' => '2019-02-11 15:19:33',
            ),
            2 => 
            array (
                'id' => 3,
                'nome' => 'Terceira Doença',
                'descricao' => 'Comentário Doença 3',
                'created_at' => '2019-02-11 15:20:19',
                'updated_at' => '2019-02-11 15:20:19',
            ),
            3 => 
            array (
                'id' => 4,
                'nome' => 'Quarta Doença',
                'descricao' => 'Comentário Doença 4',
                'created_at' => '2019-02-11 15:20:39',
                'updated_at' => '2019-02-11 15:20:39',
            ),
        ));
        
        
    }
}