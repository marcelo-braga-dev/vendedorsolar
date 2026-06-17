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
        Schema::create('loja_api_acessos', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 45);
            $table->string('metodo', 10);
            $table->string('rota');
            $table->text('parametros')->nullable();
            $table->string('sku', 32)->nullable();
            $table->unsignedSmallInteger('status');
            $table->timestamps();

            $table->index('created_at');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loja_api_acessos');
    }
};
