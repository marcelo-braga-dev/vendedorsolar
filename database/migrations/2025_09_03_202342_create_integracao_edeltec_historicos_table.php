<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('integracao_edeltec_historicos', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->timestamp('data_inicio');
            $table->timestamp('data_fim')->nullable();
            $table->text('produtos_importados')->nullable();
            $table->integer('qtd_importados')->nullable();
            $table->text('produtos_desativados')->nullable();
            $table->integer('qtd_desativados')->nullable();
            $table->string('anotacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integracao_edeltec_hostoricos');
    }
};
