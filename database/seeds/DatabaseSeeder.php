<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PessoasTableSeeder::class);
        $this->call(DoencasTableSeeder::class);
        $this->call(AnamnesesTableSeeder::class);
        $this->call(NucleosTableSeeder::class);
        $this->call(TurmasTableSeeder::class);
        $this->call(ProfessoresTableSeeder::class);
        $this->call(AnamnesesDoencasTableSeeder::class);
        $this->call(TurmasPessoasTableSeeder::class);
        $this->call(TurmasProfessoresTableSeeder::class);
    }
}
