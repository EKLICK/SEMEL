<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HistoricoProfessoresTurmas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_pessoas_turmas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nucleo_id')->nullable();
            $table->unsignedInteger('professor_id')->nullable();
            $table->Integer('inativo')->nullable();
            $table->string('comentario')->nullable();
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
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
        Schema::dropIfExists('historico_professores_turmas');
    }
}
