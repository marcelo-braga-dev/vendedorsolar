<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CidadesEstadosSeeder::class,
            ConcessionariasSeeder::class,
            IrradiacaoSolarSeeder::class,
            ProdutosSeeder::class,
            IntegracaoAldoSeeder::class,
            EstruturasSeeder::class,
            MargemPrincipalSeeder::class,
            FornecedorSeeder::class,
            TrafoSeeder::class
        ]);
    }
}
