<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstruturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::insert("
            INSERT INTO `estruturas` (`id`, `nome`) VALUES
            (1, 'Telha Colonial (Cerâmico)'),
            (2, 'Paraf. Estrut. Madeira'),
            (3, 'Paraf. Estrut. Metal'),
            (4, 'Telha Metálica Perfil 55cm'),
            (5, 'Telha Ondulada'),
            (7, 'Laje'),
            (8, 'Solo'),
            (9, 'Telha Metálica Zipada'),
            (10, 'Sem Estrutura');
            ");
        } catch (QueryException $e) {
        }
    }
}
