<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bolo;
use App\Http\Resources\BoloResource;
use App\Http\Requests\StoreBoloRequest;
use App\Http\Requests\UpdateBoloRequest;
use App\Services\BoloService;
use Illuminate\Http\JsonResponse;

class BoloController extends Controller
{
    protected BoloService $boloService;

    public function __construct(BoloService $boloService)
    {
        $this->boloService = $boloService;
    }

    // Lista todos os bolos cadastrados
    public function index(): JsonResponse
    {
        try {
            $bolos = Bolo::all();
            return response()->json([
                'data' => BoloResource::collection($bolos),
                'message' => 'Lista de bolos carregada com sucesso.',
                'status' => 200
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao listar bolos.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Cadastra um novo bolo e envia e-mails para os interessados, se houver disponibilidade
    public function store(StoreBoloRequest $request): JsonResponse
    {
        try {
            $bolo = $this->boloService->criarBoloComEmails($request->validated());
            return response()->json([
                'data' => new BoloResource($bolo),
                'message' => 'Bolo cadastrado com sucesso.',
                'status' => 201
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Exibe os dados de um bolo específico pelo ID
    public function show($id): JsonResponse
    {
        try {
            $bolo = $this->boloService->buscarPorId($id);
            return response()->json([
                'data' => $bolo,
                'message' => 'Bolo encontrado com sucesso.',
                'status' => 200
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao buscar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Atualiza os dados de um bolo específico
    public function update(UpdateBoloRequest $request, $id): JsonResponse
    {
        try {
            $bolo = $this->boloService->atualizarBolo($id, $request->all());
            return response()->json([
                'data' => $bolo,
                'message' => 'Bolo atualizado com sucesso.',
                'status' => 200
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao atualizar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Remove um bolo específico do sistema
    public function destroy($id): JsonResponse
    {
        try {
            $this->boloService->deletarBolo($id);
            return response()->json([
                'message' => 'Bolo deletado com sucesso.',
                'status' => 200
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Bolo não encontrado.'], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao deletar bolo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
