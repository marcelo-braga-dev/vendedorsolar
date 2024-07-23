<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentosInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamentos_id')->constrained('orcamentos');
            $table->integer('consumo')->nullable();
            $table->integer('consumo_ponta')->nullable();
            $table->integer('consumo_fora_ponta')->nullable();
            $table->integer('demanda')->nullable();
            $table->boolean('bloquear_edicao')->default(0);
            $table->integer('estrutura');
            $table->integer('tensao');
            $table->string('orientacao');
            $table->string('anotacoes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamentos_infos');
    }
}
