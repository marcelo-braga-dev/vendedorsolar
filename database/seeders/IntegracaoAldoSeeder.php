<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntegracaoAldoSeeder extends Seeder
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
        INSERT INTO `integracao_aldos` (`id`, `categoria`, `aldo`, `potencia`, `id_referencia`) VALUES
        (1, 'estrutura', 'TELHA METALICA PERFIL 55CM', NULL, '4'),
        (2, 'estrutura', 'PARAFUSO ESTRUTURAL MADEIRA', NULL, '2'),
        (3, 'estrutura', 'TELHA COLONIAL GANCHO', NULL, '1'),
        (4, 'estrutura', 'LAJE TRIANGULO', NULL, '7'),
        (5, 'estrutura', 'TELHA ONDULADA', NULL, '5'),
        (6, 'estrutura', 'SEM ESTRUTURA', NULL, '10'),
        (7, 'estrutura', 'SOLO', NULL, '8'),
        (8, 'estrutura', 'TELHA METALICA ZIPADA', NULL, '9'),
        (9, 'estrutura', 'PARAFUSO ESTRUTURAL FERRO', NULL, '3'),
        (10, 'inversor', 'GROWATT X', NULL, '12'),
        (11, 'inversor', 'DEYE MICRO INVERSOR', NULL, '25'),
        (12, 'inversor', 'FIMER ABB', NULL, '8'),
        (13, 'inversor', 'FRONIUS', NULL, '11'),
        (14, 'inversor', 'REFUSOL', NULL, '13'),
        (15, 'inversor', 'SMA', NULL, '14'),
        (16, 'inversor', 'ECOSOLYS', NULL, '10'),
        (17, 'inversor', 'VICTRON', NULL, ''),
        (18, 'painel', 'JINKO MONO 450W', '450', '1'),
        (19, 'painel', 'JINKO MONO 460W', '460', '1'),
        (20, 'painel', 'JINKO MONO 540W', '540', '1'),
        (21, 'painel', 'JINKO MONO BIFACIAL 530W', '530', '1'),
        (22, 'painel', 'PHONO MONO 535W', '535', '23'),
        (23, 'chaves_integracao', 'chave', NULL, 's0ls0l'),
        (24, 'chaves_integracao', 'codigo', NULL, '221726'),
        (25, 'teste', 'schedule_2', NULL, '123'),
        (26, 'painel', 'JINKO MONO 470W', '470', '1'),
        (27, 'inversor', 'GROWATT', NULL, '12'),
        (28, 'inversor', 'DEYE', NULL, '25'),
        (29, 'trafo', 'MINUZZI', NULL, '27'),
        (30, 'trafo', 'MAGNUS', NULL, '34')");
                } catch (QueryException $e) {
        }
    }
}
