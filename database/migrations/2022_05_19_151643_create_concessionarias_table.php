<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcessionariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concessionarias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('estado');
            $table->float('convencional',8, 5);
            $table->float('ponta',8, 5);
            $table->float('intermediaria',8, 5);
            $table->float('fora_ponta',8, 5);
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
        Schema::dropIfExists('concessionarias');
    }
}
