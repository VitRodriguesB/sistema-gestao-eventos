<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // CORREÇÃO AQUI:
        // Buscamos todos os eventos do banco de dados e retornamos como JSON.
        return Evento::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'local' => 'required|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'valor_inscricao' => 'required|numeric',
            'chave_pix' => 'nullable|string',
        ]);

        // A linha abaixo usa o relacionamento para associar o evento ao usuário logado
        $evento = $request->user()->eventosOrganizados()->create($validatedData);

        return response()->json($evento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        return $evento;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        // Verifica se o usuário autenticado é o organizador do evento
        if ($request->user()->id !== $evento->organizador_id) {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'local' => 'required|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'valor_inscricao' => 'required|numeric',
            'chave_pix' => 'nullable|string',
        ]);
        
        $evento->update($validatedData);

        return response()->json($evento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        // Implementar lógica de deleção aqui no futuro
    }
}