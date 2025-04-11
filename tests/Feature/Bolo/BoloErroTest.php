<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, put, delete};

uses(RefreshDatabase::class);

it('retorna 404 ao tentar visualizar bolo inexistente', function () {
    get('/api/bolos/9999', ['Accept' => 'application/json'])
        ->assertNotFound()
        ->assertJson(['message' => 'Bolo não encontrado.']);
});

it('retorna 404 ao tentar atualizar bolo inexistente', function () {
    $data = ['nome' => 'Bolo Fantasma'];

    put('/api/bolos/9999', $data, ['Accept' => 'application/json'])
        ->assertNotFound()
        ->assertJson(['message' => 'Bolo não encontrado.']);
});

it('retorna 404 ao tentar deletar bolo inexistente', function () {
    delete('/api/bolos/9999', ['Accept' => 'application/json'])
        ->assertNotFound()
        ->assertJson(['message' => 'Bolo não encontrado.']);
});
