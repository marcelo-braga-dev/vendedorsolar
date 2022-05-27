<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('clientes_id')->constrained('clientes');
            $table->foreignId('kits_id')->constrained('kits');
            $table->integer('qtd_kits');
            $table->float('taxa_comissao',6,3, true);
            $table->float('preco_cliente', 12, 2, true);
            $table->string('status', 32);
            $table->integer('geracao');
            $table->integer('cidade');
            $table->integer('estrutura');
            $table->integer('tensao');
            $table->integer('trafo')->nullable();
            $table->string('orientacao');
            $table->integer('consumo');
            $table->string('anotacoes')->nullable();
            $table->string('token');
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
        Schema::dropIfExists('orcamentos');
    }
}
