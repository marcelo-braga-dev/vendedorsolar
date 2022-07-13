<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosSeeder extends Seeder
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
            INSERT INTO `produtos` (`id`, `tipo`, `nome`, `categoria`, `img_logo`, `img_produto`, `garantia`, `ref`) VALUES
            (1, 'painel', 'Jinko', '', 'produtos/paineis/logos/3GJMjwgRzdq3ZnUQan8hMPVYfPPBmhyvCZrqJ2n2.jpg', 'produtos/paineis/produtos/MZvMijzThKKURoEyZNy68uWjYpg2oB0pk7BPYa9X.png', 'Painel Jinko: 12 Anos Contra Defeitos De Fabricação E 25 Anos De Até 84,8% Da Eficiência;', NULL),
            (2, 'painel', 'Canadian', '', 'painel/logo/canadian-logo.jpg', NULL, 'Painel Canadian Solar: 12 Anos Contra Defeitos De Fabricação E 25 Anos De Até 80% Da Eficiência.                                                               ', NULL),
            (3, 'painel', 'Trina', '', 'painel/logo/trina-logo.jpg', NULL, 'Painel Trina: 12 Anos Contra Defeitos De Fabricação  e 25 Anos De Até 84,8% De Eficiência;                                                     ', NULL),
            (4, 'painel', 'BYD', '', 'painel/logo/byd-logo.jpg', NULL, 'Painel BYD: 10 Anos Contra Defeitos de Fabricação E 25 Anos De Até 80% Da Eficiência.\r\n edit 5', NULL),
            (5, 'painel', 'Risen', '', 'painel/logo/risen-logo.jpg', NULL, 'Painel Risen: 12 Anos De Garantia E 25 Anos De Até 80% De Eficiência;                     ', NULL),
            (7, 'painel', 'Dah', '', 'painel/logo/dah-logo.jpg', NULL, 'Painel DAH: 12 Anos De Garantia de defeito de Fabricação e 25 Anos de até 84,80% de Eficiência.                     ', NULL),
            (8, 'inversor', 'Fimer ABB (Convencional)', 'convencional', 'inversor/logo/abb-logo.jpg', NULL, 'Inversor ABB: 5 anos;', NULL),
            (9, 'inversor', 'Deye (Convencional)', 'convencional', 'inversor/logo/deye-logo.jpg', 'produtos/inversores/produtos/ylKZKG6rXYhLN3D18NxppKUd1OAMH1scJXPGbcl6.png', 'Micro-inversor Deye: 20 anos;', NULL),
            (10, 'inversor', 'Ecosolys (Convencional)', 'convencional', 'inversor/logo/ecosolys-logo.jpg', NULL, 'Inversor ecoSolis: 5 anos;', NULL),
            (11, 'inversor', 'Fronius (Convencional)', 'convencional', 'inversor/logo/fronius-logo.jpg', NULL, 'Inversor Fronius: 7 anos;', NULL),
            (12, 'inversor', 'Growatt (Convencional)', 'convencional', 'inversor/logo/growatt-logo.jpg', NULL, 'Inversor Growatt: 10 anos; ', NULL),
            (13, 'inversor', 'Refusol (Convencional)', 'convencional', 'inversor/logo/refusol-logo.jpg', NULL, 'Inversor Refuso: 5 anos; ', NULL),
            (14, 'inversor', 'Sma (Convencional)', 'convencional', 'inversor/logo/sma-logo.jpg', NULL, 'Inversor SMA: 5 anos;            ', NULL),
            (15, 'inversor', 'Sofar (Convencional)', 'convencional', 'inversor/logo/sofar-logo.jpg', NULL, 'Inversor Sofar Solar: 7 anos; ', NULL),
            (16, 'inversor', 'SolarEdge (Convencional)', 'convencional', 'inversor/logo/solaredge-logo.jpg', NULL, 'Inversor Solar Edge: 12 anos; ', NULL),
            (17, 'painel', 'Luxen', '', 'painel/logo/luxen-logo.jpg', NULL, 'Painel Luxen: 10 Anos De Garantia De Fabricação E 30 Anos De Garantia De Geração De Energia;                                          ', NULL),
            (18, 'painel', 'JA Solar', '', 'painel/logo/ja-solar-logo.jpg', NULL, 'Painel JA Solar: 10 Anos De Garantia De Fabricação E 30 Anos De Garantia De Geração De Energia;                     ', NULL),
            (19, 'inversor', 'Hoymiles (Microinversor)', 'microinversor', 'inversor/logo/hoymiles-logo.jpg', NULL, 'Inversor Hoymiles: 12 anos; ', NULL),
            (21, 'inversor', 'Solis (Convencional)', 'convencional', 'inversor/logo/solis-logo.jpg', NULL, 'Inversor Solis: 5 anos;', NULL),
            (22, 'painel', 'Longi Solar', '', 'painel/logo/longi-logo.jpg', NULL, 'Painel Longi Solar: 10 anos de garantia de fabricação e 30 anos de garantia de geração de energia;', NULL),
            (23, 'painel', 'Phono Solar', '', 'painel/logo/phono-logo.jpg', NULL, 'Painel Phono Solar: 12 anos de garantia de fabricação e 25 anos de até 84,8% de Eficiência;', NULL),
            (24, 'inversor', 'Goodwe (Convencional)', 'convencional', 'produtos/inversores/logos/hAxbIY1qsK3m3553mbjUBNTNbrTnXpjjAnNU0wSO.jpg', NULL, 'Inversor Goodwe: 5 anos;', NULL),
            (25, 'inversor', 'Deye (Microinvesor)', 'microinversor', 'inversor/logo/deye-logo.jpg', 'produtos/inversores/produtos/yD87rDjBZBli0guQtAdjMeko64T6t8ecsLX5kRtV.png', 'Inversor Deye: 7 + 3 = 10 anos;', NULL),
            (26, 'painel', 'FINAME/BNDES/MDA (BYD)', '', 'painel/logo/byd-finame-logo.jpg', NULL, 'Painel BYD: 10 Anos Contra Defeitos de Fabricação E 25 Anos De Até 80% Da Eficiência.                                                                                                          ', NULL),
            (27, 'trafo', 'Minuzzi', '', 'produtos/trafos/logos/98mMy7MirtqLk7qqH0gu0rXtPblFhIJMtYjqyj59.jpg', 'produtos/trafos/produtos/gWjqbSzCi1LRXpqGC6AJT28AhxuG4okK0tJdvjzL.jpg', 'dsfsdf edit 1', NULL),
            (28, 'inversor', 'Weg (Convencional) ', 'convencional', 'produtos/inversores/logos/cEWMop0tTX20cBFBxgar8Z4GhsHI2KDG0Sd15VDd.png', NULL, '10 anos de garantia', NULL);");
        } catch (QueryException $e) {
        }
    }
}
