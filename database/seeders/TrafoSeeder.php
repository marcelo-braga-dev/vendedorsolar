<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrafoSeeder extends Seeder
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
                INSERT INTO `trafos` (`id`, `sku`, `modelo`, `produtos_id`, `potencia`, `margem`, `preco_cliente`, `preco_fornecedor`, `fornecedor`, `status`, `status_fornecedor`, `observacoes`, `created_at`, `updated_at`) VALUES
                (3, '59858-2', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 12 a 18 kw', 27, '20.00', '80', 42392.09, 23551.16, 1, 0, 0, NULL, NULL, NULL),
                (4, '32541-8', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 19 a 23 kw', 27, '25.00', '45.09', 6913.63, 4765.06, 1, 0, 0, NULL, NULL, NULL),
                (5, '31556-0', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 24 a 27,6 kw', 27, '30.00', '49.96', 83208.98, 55487.45, 1, 0, 0, NULL, NULL, NULL),
                (6, '56777-9', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 28 a 41 kw', 27, '45.00', '34', 10298.66, 6436.66, 1, 0, 0, NULL, NULL, NULL),
                (7, '32621-4', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 37 a 50 kw', 27, '55.00', '14', 11811.06, 7381.91, 1, 0, 0, NULL, NULL, NULL),
                (8, '32762-2', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 67 a 78 kw', 27, '85.00', '23', 15759.22, 9849.51, 1, 0, 0, NULL, NULL, NULL),
                (9, '33723-5', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 67 a 90 kw', 27, '100.00', '20', 13682.05, 11401.71, 1, 0, 0, NULL, NULL, NULL),
                (10, '34890-7', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 95 a 115 kw', 27, '125.00', '74', 23623.70, 14764.81, 1, 0, 0, NULL, NULL, NULL),
                (11, '33724-9', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 120 a 135kw', 27, '150.00', '71', 30485.22, 19053.26, 1, 0, 0, NULL, NULL, NULL),
                (12, '45110-0', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 140 a 185 kw', 27, '200.00', '34.01', 38080.56, 28416.21, 1, 0, 0, NULL, NULL, NULL),
                (13, '45111-4', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 190 a 230 kw', 27, '250.00', '65', 54717.89, 33162.36, 1, 0, 0, NULL, NULL, NULL),
                (14, '45112-8', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 235 a 275 kw', 27, '300.00', '85.01', 71956.98, 38893.56, 1, 0, 0, NULL, NULL, NULL),
                (15, '56778-3', 'TRANSFORMADOR ISOLADOR TRIFASICO MINUZZI 55 a 65 kw', 27, '70.00', '65', 13976.18, 8735.11, 1, 0, 0, NULL, NULL, NULL);
            ");
        } catch (QueryException $e) {
        }
    }
}
