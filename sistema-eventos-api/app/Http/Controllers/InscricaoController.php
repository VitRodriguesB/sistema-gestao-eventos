<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    public function inscrever(Request $request, Evento $evento)
    {
        $user = Auth::user();

        // Evita inscrições duplicadas
        $existe = Inscricao::where('user_id', $user->id)
            ->where('evento_id', $evento->id)
            ->first();

        if ($existe) {
            return response()->json(['message' => 'Você já está inscrito neste evento.'], 400);
        }

        $inscricao = Inscricao::create([
            'user_id' => $user->id,
            'evento_id' => $evento->id,
            'status_pagamento' => 'pendente',
        ]);

        return response()->json([
            'message' => 'Inscrição realizada com sucesso!',
            'inscricao' => $inscricao
        ], 201);
    }
}
