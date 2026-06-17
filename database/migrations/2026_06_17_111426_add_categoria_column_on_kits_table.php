<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaColumnOnKitsTable extends Migration
{
    public function up()
    {
        Schema::table('kits', function (Blueprint $table) {
            $table->string('categoria', 32)->nullable()->after('estrutura');
        });
    }

    public function down()
    {
        Schema::table('kits', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
}
