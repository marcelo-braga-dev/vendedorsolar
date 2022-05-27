<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrradiacaoSolarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irradiacao_solars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cidades_estados_id')->constrained('cidades_estados');
            $table->string('media', 8);
            $table->string('jan', 8);
            $table->string('fev', 8);
            $table->string('mar', 8);
            $table->string('abr', 8);
            $table->string('mai', 8);
            $table->string('jun', 8);
            $table->string('jul', 8);
            $table->string('ago', 8);
            $table->string('set', 8);
            $table->string('out', 8);
            $table->string('nov', 8);
            $table->string('dez', 8);
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
        Schema::dropIfExists('irradiacao_solars');
    }
}
