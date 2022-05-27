<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_kits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamentos_id')->constrained('orcamentos');
            $table->foreignId('kits_id')->constrained('kits');
            $table->float('preco_cliente', 12,2)->nullable();
            $table->float('preco_fornecedor', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orcamento_kits');
    }
}
