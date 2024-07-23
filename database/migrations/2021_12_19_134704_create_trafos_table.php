<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trafos', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 16)->nullable();
            $table->string('modelo');
            $table->foreignId('produtos_id')->constrained('produtos');
            $table->float('potencia', 8, 3);
            $table->float('margem', 8, 3)->nullable();
            $table->float('preco_cliente', 12,2);
            $table->float('preco_fornecedor', 12, 2);
            $table->bigInteger('fornecedor');
            $table->boolean('status')->default(true);
            $table->boolean('status_fornecedor')->default(true);
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
        Schema::dropIfExists('trafos');
    }
}
