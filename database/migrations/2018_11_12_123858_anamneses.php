<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Anamneses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ananmeses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('possui_doenca')->nullable();
            $table->boolean('toma_medicacao')->nullable();
            $table->boolean('alergia_medicacao')->nullable();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->boolean('fumante')->nullable();
            $table->boolean('cirurgia')->nullable();
            $table->boolean('dor_muscular')->nullable();
            $table->boolean('dor_ossea')->nullable();
            $table->boolean('dor_articular')->nullable();
            $table->boolean('atestado')->nullable();
            $table->string('observacao')->nullable();
            $table->unsignedInteger('pessoa_id')->nullable();
            $table->foreign('pessoa_id')->references('id')->on('pessoas')->onDelete('set null');
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
        Schema::drop('ananmeses');
    }
}
