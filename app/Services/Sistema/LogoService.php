<?php

namespace App\Services\Sistema;

use App\Models\Configs;

class LogoService
{
    private string $chave = 'logo_principal';

    public function getChave(): string
    {
        return $this->chave;
    }

    public function update($request)
    {
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                deleteFileStorage(getLogoPrincipal(true));

                $img = $request->logo->store('sistema/plataforma');

                (new Configs())->newQuery()
                    ->updateOrCreate(
                        ['meta_key' => $this->chave],
                        ['value' => $img]
                    );
            }
        }
    }
}
