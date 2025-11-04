<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscricao extends Model
{
    use HasFactory;

    /**
     * Informa ao Laravel o nome correto da tabela.
     */
    protected $table = 'inscricoes'; // <-- ADICIONE ESTA LINHA

    protected $fillable = [
        'user_id',
        'evento_id',
        'status_pagamento',
    ];

    // ... (o resto do arquivo)
}