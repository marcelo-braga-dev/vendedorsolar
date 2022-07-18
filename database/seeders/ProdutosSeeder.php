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
                (1, 'painel', 'Jinko', '', 'default/produtos/zlqYMI7SfEBmfFGvQAqDYESIag75sSuW62NlPVRp.jpg', 'default/produtos/uedBV659lAz4kOj8kluWHXgp8SELLy3XqqcakU7R.png', 'Painel Jinko: 12 Anos Contra Defeitos De Fabricação E 25 Anos De Até 84,8% Da Eficiência;', NULL),
                (2, 'painel', 'Canadian', '', 'default/produtos/PHGcpDqfBEUTmVT30sOmsPF2pY6JzmcOBWk9FdX2.jpg', 'default/produtos/AIHMYIVXHqDz97RQW9XuHQuA5qc5E7hgJ2v7Bs3h.png', 'Painel Canadian Solar: 12 Anos Contra Defeitos De Fabricação E 25 Anos De Até 80% Da Eficiência.', NULL),
                (3, 'painel', 'Trina', '', 'default/produtos/cObJ1kvN39YKTwUvxeCqN4Od91dD4bWTadrNZfZ4.jpg', 'default/produtos/pCopMbgAaD8qnY3BfCSVcyp8JfouxGeTn3PMa9J7.png', 'Painel Trina: 12 Anos Contra Defeitos De Fabricação  e 25 Anos De Até 84,8% De Eficiência;', NULL),
                (4, 'painel', 'BYD', '', 'default/produtos/xiddjo8s7ccsUT4TdlDIsM4qzm9Suvj81IegU3OT.jpg', 'default/produtos/dGtVx2flBkYrkm5wUjdzas9bZVHmnBUtRNQdo8YM.png', 'Painel BYD: 10 Anos Contra Defeitos de Fabricação E 25 Anos De Até 80% Da Eficiência.\r\n edit 5', NULL),
                (5, 'painel', 'Risen', '', 'default/produtos/eMUY8uKgZEpuXgEuMSxKB7u4TNuhU68aK8CRQubl.jpg', 'default/produtos/htcV8iPXcvrrKcncS2NPKPJUnF38ETxwfnH1Ola6.png', 'Painel Risen: 12 Anos De Garantia E 25 Anos De Até 80% De Eficiência;', NULL),
                (7, 'painel', 'Dah', '', 'default/produtos/6WXpYzyLyEDUWEXajoBlKKSlPe2g7QpI4BbNy1Ll.jpg', 'default/produtos/IzonKy8oeftEnF442Quo4v0h5SKEMIhLTIfufJuw.png', 'Painel DAH: 12 Anos De Garantia de defeito de Fabricação e 25 Anos de até 84,80% de Eficiência.', NULL),
                (8, 'inversor', 'Fimer ABB (Convencional)', 'convencional', 'default/produtos/2j3UrazQT9z3jlvTRFZygmRZ5l8Wwr29j4wMChgh.jpg', 'default/produtos/WYSLq0BZdGNk1Qe6mWgFQ5DxKPXulGsN3SCp3Zxu.jpg', 'Inversor ABB: 5 anos;', NULL),
                (9, 'inversor', 'Deye (Microinvesor)', 'microinversor', 'default/produtos/HvHJwSbIuj9P2liUqawdRC8MWISNyPM1KgftIroP.jpg', 'default/produtos/ju953OvdWZbnjNTeKGicqFe6bF10DIAsGdJA5gg0.jpg', 'Micro-inversor Deye: 20 anos;', NULL),
                (10, 'inversor', 'Ecosolys (Convencional)', 'convencional', 'default/produtos/IcZIMmSoMEiUuAo1nS6SKvHcWaBMTfTlmFtLh7Jg.jpg', 'default/produtos/bz8PyvSht7J8CpPMyM67x6dfGvgieXOlGeg1Fqjv.jpg', 'Inversor ecoSolis: 5 anos;', NULL),
                (11, 'inversor', 'Fronius (Convencional)', 'convencional', 'default/produtos/YqF6U5fpV1NzOzMNHUKPbjXDYbjsbHCDJQsAf68i.jpg', 'default/produtos/6WE7z0LNn0L9vYWPOj9OHvSbNgsedGMH2n7duBTz.jpg', 'Inversor Fronius: 7 anos;', NULL),
                (12, 'inversor', 'Growatt (Convencional)', 'convencional', 'default/produtos/NJ5ZMzF0KfAqqeQWoGkDZoDgu40MAUAM8fhXYJ1j.jpg', 'default/produtos/OfgLGaIDxcfh2co9WxwgiDvYVAsfSjKGOI1qYUBW.jpg', 'Inversor Growatt: 10 anos;', NULL),
                (13, 'inversor', 'Refusol (Convencional)', 'convencional', 'default/produtos/4OUo0xcm9Vtlti2ajGxOpHU5NpBXyCRXmnxnQTni.jpg', 'default/produtos/dpeaLmOoYFWV65W2dFVsgBrgb6car2WhpgW2cKf0.jpg', 'Inversor Refusol: 5 anos;', NULL),
                (14, 'inversor', 'Sma (Convencional)', 'convencional', 'default/produtos/mFCzdWIK128SbuAvRVDgRdLGxlBIby4ZfCwboiy3.jpg', 'default/produtos/WQNIeupgbJxgErTXR9NxoBlQ27OpHrtLeDGOShcp.jpg', 'Inversor SMA: 5 anos;', NULL),
                (15, 'inversor', 'Sofar (Convencional)', 'convencional', 'default/produtos/sPfcG3reuRYfePoOl78jTY7KNlVnFgojUm6suBON.jpg', 'default/produtos/iJaBkV4bzqHacD1ofCHsIOMnbV5tJlrfGKwtmIaZ.jpg', 'Inversor Sofar Solar: 7 anos;', NULL),
                (16, 'inversor', 'SolarEdge (Convencional)', 'convencional', 'default/produtos/NLZlbbvPAICGJpBB82kyiwlsTZCRu9VmGUwy2dBd.jpg', 'default/produtos/IVXZKkv0y8oZY2xKhOpQtmnKVdOCW7sptbMheJRW.jpg', 'Inversor Solar Edge: 12 anos;', NULL),
                (17, 'painel', 'Luxen', '', 'default/produtos/nRYYd1GMv0V3VxWObLHY8R0UqYx93Si4W4dnYRev.jpg', 'default/produtos/DenfyQ096Nrss2FLCS3UkzrAEvLIDYuncZ8OmIMN.png', 'Painel Luxen: 10 Anos De Garantia De Fabricação E 30 Anos De Garantia De Geração De Energia;', NULL),
                (18, 'painel', 'JA Solar', '', 'default/produtos/VQjAhe3o0EZboJ1jFRGhxqtwBXxdhStRVBrXAyuG.jpg', 'default/produtos/8QJPoDRUSkOWu6bj9n3cRcRoHVAwXl7320zfVyuI.png', 'Painel JA Solar: 10 Anos De Garantia De Fabricação E 30 Anos De Garantia De Geração De Energia;', NULL),
                (19, 'inversor', 'Hoymiles (Microinvesor)', 'microinversor', 'default/produtos/wZdpg83hAkE7Fnj7GOdo9Mg06ilZcFY07tcKQMMW.jpg', 'default/produtos/XmkypLP239rYicgjgSvIkIBF6Zpx9cnwHT5IQZ4y.jpg', 'Inversor Hoymiles: 12 anos;', NULL),
                (21, 'inversor', 'Solis (Convencional)', 'convencional', 'default/produtos/r2dVTgkoXnpvppxNpOLsUJ0KTbcxfW94wUVnZo7q.jpg', 'default/produtos/9T0T5jJBhoPvzxFsJQ4t2CRlRFin7PNyWf4LeX2I.jpg', 'Inversor Solis: 5 anos;', NULL),
                (22, 'painel', 'Longi Solar', '', 'default/produtos/SWRf4ZHXngdqT6Ns2jYZFPBvk4U3KJY4vcHH7bMQ.jpg', 'default/produtos/P1XTwKG3idXICle7dGZ1Kt53PlBtZZWGCyzARXTv.png', 'Painel Longi Solar: 10 anos de garantia de fabricação e 30 anos de garantia de geração de energia;', NULL),
                (23, 'painel', 'Phono Solar', '', 'default/produtos/8kAkV1bn5xSh0djgKW0wsOfJ7tOcetdZExslBTX6.jpg', 'default/produtos/cgYlTmqpzMgi94AOj5XJIaiY02X44HyqzNx4gEbp.png', 'Painel Phono Solar: 12 anos de garantia de fabricação e 25 anos de até 84,8% de Eficiência;', NULL),
                (24, 'inversor', 'Goodwe (Convencional)', 'convencional', 'default/produtos/kIirS7p8Nk2NROZrO1NH9ouy5JngOzYNAu9P3fC3.jpg', 'default/produtos/s2jat71siadt1Op3p6ByskAFZKn5WyCnhBS9qLaS.jpg', 'Inversor Goodwe: 5 anos;', NULL),
                (25, 'inversor', 'Deye (Convencional)', 'convencional', 'default/produtos/zVG78sF14ROKeeDzuUe1vfhwVfX0vyINxsEKN2WD.jpg', 'default/produtos/j8DFNpsfWAw2HY78lLOtkO24nFlDF4uMtsH6UT6o.jpg', 'Inversor Deye: 7 + 3 = 10 anos;', NULL),
                (26, 'painel', 'FINAME/BNDES/MDA (BYD)', '', 'default/produtos/BF8cSIySVulJAqZ0zw6aPeD0iXBMqixLmKfgUW4D.jpg', 'default/produtos/MuBvDH8jwvj9rEtdlB95NgA4GPFCBXBX7hrMoqqT.png', 'Painel BYD: 10 Anos Contra Defeitos de Fabricação E 25 Anos De Até 80% Da Eficiência.', NULL),
                (27, 'trafo', 'Minuzzi', '', 'default/produtos/Om3En4vsi2SskLUucWViZqo4gGPPBvqzn7XvnC64.jpg', 'default/produtos/luSLbHV3oiXc5bLPDQyCfvFZ41mH802gWOAlsDqW.jpg', NULL, NULL),
                (34, 'trafo', 'Magnus', NULL, 'default/produtos/HxtJJWsIH7kqVmDEH0peLLEdyY9DWze5ZZOnD9yA.jpg', 'default/produtos/YdNFAFV5tWIL3pdUSzbPVyF2OMHS2EESFT7UstFg.jpg', NULL, NULL),
                (35, 'painel', 'Ulica Solar', NULL, 'default/produtos/7P3jYOufjuX9kJaA2KqBZPe7xqubxpXdTpOzLz16.jpg', 'default/produtos/ye7S1SlLshrPFzgPlvfS7SJq46PhdcfMelTAiCDa.png', 'Painel Ulica Solar: 12 Anos Contra Defeitos De Fabricação e 25 Anos De Até 84,8% De Eficiência;', NULL);");
        } catch (QueryException $e) {
        }
    }
}
