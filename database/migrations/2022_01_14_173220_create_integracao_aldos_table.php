<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegracaoAldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integracao_aldos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('aldo');
            $table->string('potencia', 16)->nullable();
            $table->string('id_referencia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integracao_aldos');
    }
}
