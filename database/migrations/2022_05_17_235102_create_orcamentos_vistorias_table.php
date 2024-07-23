<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentosVistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos_vistorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orcamentos_id')->constrained('orcamentos');
            $table->string('largura_telhado')->nullable();
            $table->string('altura_telhado')->nullable();
            $table->string('slug_disjuntor')->nullable();
            $table->string('slug_padrao_energia')->nullable();
            $table->string('slug_telhado')->nullable();
            $table->string('slug_fiacao')->nullable();
            $table->string('slug_medidor')->nullable();
            $table->string('slug_outros')->nullable();
            $table->string('slug_arquivo_1')->nullable();
            $table->string('slug_arquivo_2')->nullable();
            $table->string('slug_arquivo_3')->nullable();
            $table->string('observacoes')->nullable();
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
        Schema::dropIfExists('vistoria_orcamentos');
    }
}
