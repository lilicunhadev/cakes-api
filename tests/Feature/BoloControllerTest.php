<?php

use App\Models\Bolo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, post, put, delete};

uses(RefreshDatabase::class);

it('lista todos os bolos', function () {
    Bolo::factory()->count(3)->create();

    get('/api/bolos')
        ->assertOk()
        ->assertJsonCount(3, 'data');
});

it('cria um novo bolo', function () {
    $data = [
        'nome' => 'Bolo de Chocolate',
        'peso' => 1000,
        'valor' => 50.5,
        'quantidade_disponivel' => 5,
        'emails_interessados' => ['teste@example.com'],
    ];

    post('/api/bolos', $data)
        ->assertCreated()
        ->assertJsonPath('data.nome', 'Bolo de Chocolate');
});

it('exibe um bolo existente', function () {
    $bolo = Bolo::factory()->create();

    get("/api/bolos/{$bolo->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $bolo->id);
});

it('atualiza um bolo existente', function () {
    $bolo = Bolo::factory()->create();

    $update = ['nome' => 'Bolo de Cenoura'];

    put("/api/bolos/{$bolo->id}", $update)
        ->assertOk()
        ->assertJsonPath('data.nome', 'Bolo de Cenoura');
});

it('deleta um bolo existente', function () {
    $bolo = Bolo::factory()->create();

    delete("/api/bolos/{$bolo->id}")
        ->assertOk()
        ->assertJson(['message' => 'Bolo deletado com sucesso']);
});
