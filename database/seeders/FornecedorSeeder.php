<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('fornecedores')->insert([
                'id' => 1,
                'nome' => 'Aldo'
            ]);
        } catch (QueryException $e) {
        }
    }
}
