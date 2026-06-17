<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitImagem extends Model
{
    protected $table = 'kit_imagens';

    protected $fillable = [
        'kit_id',
        'url',
        'principal',
        'ordem',
    ];

    public function kit()
    {
        return $this->belongsTo(Kits::class, 'kit_id');
    }

    /**
     * Soma ao álbum de cada kit as imagens recebidas nesta rodada de sincronização
     * (por URL — não duplica as que já existem) e marca a primeira imagem fornecida
     * pela distribuidora nesta rodada como capa (`principal`) do produto, mesmo que
     * ela já estivesse no álbum.
     *
     * @param array<int, array<int, array{url: string, principal: bool}>> $imagensPorKitId
     */
    public function adicionarAoAlbum(array $imagensPorKitId): void
    {
        if (empty($imagensPorKitId)) {
            return;
        }

        $kitIds = array_keys($imagensPorKitId);

        $existentes = $this->newQuery()
            ->whereIn('kit_id', $kitIds)
            ->get(['kit_id', 'url', 'ordem'])
            ->groupBy('kit_id');

        $novasLinhas = [];
        $capasPorKit = [];
        $agora       = now();

        foreach ($imagensPorKitId as $kitId => $imagens) {
            $existentesDoKit = $existentes->get($kitId, collect());
            $urlsExistentes  = $existentesDoKit->pluck('url')->flip();
            $proximaOrdem    = ($existentesDoKit->max('ordem') ?? -1) + 1;

            foreach ($imagens as $imagem) {
                if (isset($urlsExistentes[$imagem['url']])) {
                    continue;
                }

                $novasLinhas[] = [
                    'kit_id'     => $kitId,
                    'url'        => $imagem['url'],
                    'principal'  => false,
                    'ordem'      => $proximaOrdem++,
                    'created_at' => $agora,
                    'updated_at' => $agora,
                ];
            }

            if (!empty($imagens[0]['url'])) {
                $capasPorKit[$kitId] = $imagens[0]['url'];
            }
        }

        if (!empty($novasLinhas)) {
            $this->newQuery()->insert($novasLinhas);
        }

        if (!empty($capasPorKit)) {
            $this->newQuery()->whereIn('kit_id', array_keys($capasPorKit))->update(['principal' => false]);

            foreach ($capasPorKit as $kitId => $capaUrl) {
                $this->newQuery()
                    ->where('kit_id', $kitId)
                    ->where('url', $capaUrl)
                    ->update(['principal' => true]);
            }
        }
    }
}
