<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMargemVendaEstruturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('margem_venda_estruturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estruturas_id')->constrained('estruturas');
            $table->float('margem', 8, 3);
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
        Schema::dropIfExists('margem_venda_estruturas');
    }
}
