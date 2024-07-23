<?php

use Illuminate\Support\Facades\Route;

Route::get('/contratos-gerados/{id}', [
    App\Http\Controllers\Vendedor\Contratos\ContratosController::class, 'show'
])->name('contratos.contratos-gerados.show');
