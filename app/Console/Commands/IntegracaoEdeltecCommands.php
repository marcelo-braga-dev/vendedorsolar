<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Integracoes\Edeltec\EdeltecIntegracao;
use Illuminate\Console\Command;

class IntegracaoEdeltecCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:integracao-edeltec';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa a integração com a Edeltec todos os dias às 04h';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new EdeltecIntegracao())->init();
        $this->info('Integração com Edeltec executada com sucesso!');
    }
}
