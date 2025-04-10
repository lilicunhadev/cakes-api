<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bolo;
use App\Http\Resources\BoloResource;

class BoloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BoloResource::collection(Bolo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'peso' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'quantidade_disponivel' => 'required|integer|min:0',
            'emails_interessados' => 'nullable|array',
            'emails_interessados.*' => 'email',
        ]);

        $bolo = Bolo::create([
            ...$validated,
            'emails_interessados' => $validated['emails_interessados'] ?? [],
        ]);

        return new BoloResource($bolo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bolo $bolo)
    {
        return new BoloResource($bolo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bolo $bolo)
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'peso' => 'sometimes|required|integer|min:1',
            'valor' => 'sometimes|required|numeric|min:0',
            'quantidade_disponivel' => 'sometimes|required|integer|min:0',
            'emails_interessados' => 'nullable|array',
            'emails_interessados.*' => 'email',
        ]);

        $bolo->update($validated);

        return new BoloResource($bolo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bolo $bolo)
    {
        $bolo->delete();
        return response()->json(['message' => 'Bolo deletado com sucesso']);
    }
}
