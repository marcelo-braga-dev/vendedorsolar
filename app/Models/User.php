<?php

namespace App\Models;

use App\src\Usuarios\Admin;
use App\src\Usuarios\AdminVendedor;
use App\src\Usuarios\Vendedores;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'tipo',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTipoUsuario(int $id)
    {
        return $this->newQuery()->find($id)->tipo ?? null;
    }

    public function cadastrar(string $nome, string $email, string $tipo, $status)
    {
        try {
            return $this->newQuery()
                ->create([
                    'name' => $nome,
                    'email' => strtolower($email),
                    'password' => Hash::make('1234'),
                    'tipo' => $tipo,
                    'status' => $status ? 1 : 0
                ]);
        } catch (QueryException $e) {
            throw new \DomainException('Não é possível usar esse email.');
        }
    }

    public function atualizar($request, $id)
    {
        try {
            $this->newQuery()
                ->where('id', '=', $id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'status' => $request->status ? 1 : 0
                ]);
        } catch (QueryException $e) {
            throw new \DomainException('Não é possível usar esse email.');
        }
    }

    public function metas($id)
    {
        return (new UserMeta())->metas($id);
    }

    public function clientes(int $id)
    {
        return (new Clientes())->newQuery()
            ->where('users_id', '=', $id)
            ->orderBy('id', 'DESC')->get();
    }

    public function vendedores()
    {
        return $this->query()->where('tipo', '=', (new Vendedores())->getChave())
            ->orderBy('id', 'DESC')->get();
    }

    public function vendedoresPaginate()
    {
        return $this->query()->where('tipo', '=', (new Vendedores())->getChave())
            ->orderBy('id', 'DESC')->paginate();
    }

    public function admins()
    {
        return $this->query()
            ->where('tipo', '=', (new Admin())->getChave())
            ->orderBy('id', 'DESC')->get();
    }

    public function adminVendedores()
    {
        return $this->query()
            ->where('tipo', '=', (new AdminVendedor())->getChave())
            ->orderBy('id', 'DESC')->get();
    }
}
