<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 16)->nullable();
            $table->string('modelo');
            $table->float('potencia_kit');
            $table->bigInteger('marca_inversor');
            $table->bigInteger('marca_painel');
            $table->bigInteger('potencia_inversor');
            $table->bigInteger('potencia_painel');
            $table->float('margem', 8, 3);
            $table->float('preco_fornecedor', 12, 2);
            $table->integer('fornecedor');
            $table->boolean('status')->default(true);
            $table->boolean('status_fornecedor')->default(true);
            $table->string('tensao', 4);
            $table->integer('estrutura');
            $table->string('produtos', 3000);
            $table->string('complementos')->nullable();
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
        Schema::dropIfExists('kits');
    }
}
