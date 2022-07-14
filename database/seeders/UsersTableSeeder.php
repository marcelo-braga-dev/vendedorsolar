<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('users')->insert([
                [
                    'name' => 'Admin Teste 1',
                    'email' => 'admin@teste.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('10203040'),
                    'tipo' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now()
                ], [
                    'name' => 'Vendedor Teste 1',
                    'email' => 'vendedor@teste.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('10203040'),
                    'tipo' => 'vendedor',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        } catch (QueryException $e) {
        }
    }
}
