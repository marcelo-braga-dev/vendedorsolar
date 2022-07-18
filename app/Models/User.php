<?php

namespace App\Models;

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
            throw new \DomainException();
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
            modalErro('Não é possível usar esse email.');
            throw new \DomainException();
        }
    }

    public function metas($id)
    {
        $meta = new UserMeta();
        return $meta->metas($id);
    }

    public function clientes(int $id)
    {
        return Clientes::query()->where('users_id', '=', $id)->orderBy('id', 'DESC')->paginate();
    }

    public function orcamentos(int $id)
    {
        return Orcamentos::query()->where('users_id', '=', $id)->orderBy('id', 'DESC')->paginate();
    }

    public function vendedores(): LengthAwarePaginator
    {
        return $this->query()->where('tipo', '=', 'vendedor')->orderBy('id', 'DESC')->paginate(20);
    }

    public function admins(): LengthAwarePaginator
    {
        return $this->query()->where('tipo', '=', 'admin')->orderBy('id', 'DESC')->paginate(20);
    }
}
