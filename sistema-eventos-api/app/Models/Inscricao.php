<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscricao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'evento_id',
        'status_pagamento',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
