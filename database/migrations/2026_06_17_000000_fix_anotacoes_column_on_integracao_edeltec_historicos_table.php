<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('integracao_edeltec_historicos', function (Blueprint $table) {
            $table->text('anotacoes')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('integracao_edeltec_historicos', function (Blueprint $table) {
            $table->string('anotacoes')->nullable()->change();
        });
    }
};
