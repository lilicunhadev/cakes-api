<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bolo;
use App\Http\Resources\BoloResource;
use App\Jobs\EnviarEmailBoloDisponivel;
use App\Http\Requests\StoreBoloRequest;
use App\Http\Requests\UpdateBoloRequest;

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
    public function store(StoreBoloRequest $request)
    {
        try {
            $bolo = Bolo::create([
                ...$request->validated(),
                'emails_interessados' => $request->validated()['emails_interessados'] ?? [],
            ]);

            if ($bolo->quantidade_disponivel > 0 && !empty($request->validated()['emails_interessados'])) {
                collect($request->validated()['emails_interessados'])
                    ->chunk(1000)
                    ->each(function ($chunk, $index) use ($bolo) {
                        EnviarEmailBoloDisponivel::dispatch(
                            $bolo->nome,
                            $chunk->toArray()
                        )->delay(now()->addSeconds($index * 30));
                    });
            }

            return new BoloResource($bolo);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bolo $bolo)
    {
        if (!$bolo) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        }

        return new BoloResource($bolo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoloRequest $request, Bolo $bolo)
    {
        if (!$bolo) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        }

        try {
            $bolo->update($request->validated());

            return new BoloResource($bolo);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao atualizar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bolo $bolo)
    {
        if (!$bolo) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        }

        try {
            $bolo->delete();
            return response()->json(['message' => 'Bolo deletado com sucesso']);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao deletar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
