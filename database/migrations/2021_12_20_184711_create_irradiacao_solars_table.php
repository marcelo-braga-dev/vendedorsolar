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
            $table->float('media', 5, 3);
            $table->float('jan', 5, 3);
            $table->float('fev', 5, 3);
            $table->float('mar', 5, 3);
            $table->float('abr', 5, 3);
            $table->float('mai', 5, 3);
            $table->float('jun', 5, 3);
            $table->float('jul', 5, 3);
            $table->float('ago', 5, 3);
            $table->float('set', 5, 3);
            $table->float('out', 5, 3);
            $table->float('nov', 5, 3);
            $table->float('dez', 5, 3);
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
