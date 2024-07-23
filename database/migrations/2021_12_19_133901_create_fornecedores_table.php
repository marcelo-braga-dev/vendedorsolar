<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj', 32)->nullable();
            $table->float('margem', 5, 2)->nullable();
            $table->string('celular', 32)->nullable();
            $table->string('representante')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone', 32)->nullable();
            $table->string('site')->nullable();
            $table->string('anotacoes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
