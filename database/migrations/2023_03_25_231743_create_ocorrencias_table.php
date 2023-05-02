<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcorrenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->time('hora');
            $table->string('posto');
            $table->unsignedBigInteger('topicos_id'); // novo campo para armazenar o ID do tópico
            $table->foreign('topicos_id')->references('id')->on('topicos');
            $table->string('nome_salva_vidas');
            $table->string('nome_vitima');
            $table->string('grau');
            $table->integer('sexo');
            $table->integer('idade');
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo']);
            $table->string('profissao');
            $table->string('cidade');
            $table->string('uf');
            $table->string('endereco');
            $table->boolean('turista');
            $table->longText('observacao');
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
        Schema::dropIfExists('ocorrencias');
    }
}
