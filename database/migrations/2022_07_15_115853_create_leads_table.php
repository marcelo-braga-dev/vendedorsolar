<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->bigInteger('vendedor')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('consumo')->nullable();
            $table->string('dados')->nullable();
            $table->string('origem')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('leads');
    }
}
