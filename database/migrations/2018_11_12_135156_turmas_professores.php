<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurmasProfessores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turmas_professores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('turma_id')->nullable();
            $table->unsignedInteger('professor_id')->nullable();
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('set null');
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
