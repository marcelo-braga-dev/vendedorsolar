<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamentos_id')->constrained('orcamentos');
            $table->foreignId('users_id')->constrained('users');
            $table->string('nome_cliente');
            $table->string('documento_cliente', 32);
            $table->string('endereco');
            $table->string('potencia_projeto', 8);
            $table->string('qtd_paineis', 4);
            $table->string('qtd_inversor', 4);
            $table->string('potencia_inversor');
            $table->string('consumo', 16);
            $table->string('garantia_paineis');
            $table->string('garantia_inversor');
            $table->string('valor_projeto', 16);
            $table->string('formas_pagamento', 512);
            $table->string('clausulas_adicionais', 1000)->nullable();
            $table->string('geracao',16);
            $table->string('produtos', 3000);
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
        Schema::dropIfExists('contratos');
    }
}
