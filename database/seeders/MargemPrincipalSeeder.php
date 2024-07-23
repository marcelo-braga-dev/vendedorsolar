<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MargemPrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('margens_vendas')->insert([
                'id' => 1,
                'nome' => 'padrao',
                'potencia' => 10.000,
                'margem' => 50.000,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (QueryException $e) {
        }
    }
}
