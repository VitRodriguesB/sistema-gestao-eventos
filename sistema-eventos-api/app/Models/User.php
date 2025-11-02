<?php

namespace App\Models;

// 1. Importe a interface MustVerifyEmail
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// 2. Implemente a interface na declaração da classe
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'perfil', // Adicionado o campo 'perfil'
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
        'password' => 'hashed',
    ];

    /**
     * Define a relação onde um usuário (Organizador) pode ter muitos eventos.
     */
    public function eventosOrganizados()
    {
        return $this->hasMany(Evento::class, 'organizador_id');
    }
    public function inscricoes()
{
    return $this->hasMany(Inscricao::class);
}

}