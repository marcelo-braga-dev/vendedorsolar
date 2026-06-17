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
        Schema::table('integracao_edeltec_historicos', function (Blueprint $table) {
            $table->mediumText('produtos_importados')->nullable()->change();
            $table->mediumText('produtos_desativados')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('integracao_edeltec_historicos', function (Blueprint $table) {
            $table->text('produtos_importados')->nullable()->change();
            $table->text('produtos_desativados')->nullable()->change();
        });
    }
};
