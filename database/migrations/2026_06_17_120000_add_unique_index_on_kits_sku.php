<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexOnKitsSku extends Migration
{
    public function up()
    {
        Schema::table('kits', function (Blueprint $table) {
            $table->unique('sku');
        });
    }

    public function down()
    {
        Schema::table('kits', function (Blueprint $table) {
            $table->dropUnique(['sku']);
        });
    }
}
