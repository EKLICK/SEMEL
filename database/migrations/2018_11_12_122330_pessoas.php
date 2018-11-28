<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cidade')->nullable();
            $table->string('nome');
            $table->string('nascimento')->nullable();
            $table->string('rg')->nullable();
            $table->string('cpf')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('telefone_emergencia')->nullable();
            $table->string('nome_do_pai')->nullable();
            $table->string('nome_da_mae')->nullable();
            $table->string('pessoa_emergencia')->nullable();
            $table->string('convenio_medico')->nullable();
            $table->integer('filhos')->default(0);
            $table->integer('irmaos')->default(0);
            $table->enum('sexo', ['M','F'])->nullable();
            $table->string('estado_civil')->nullable();
            $table->boolean('mora_com_os_pais')->default(false);
            $table->boolean('inativo')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
