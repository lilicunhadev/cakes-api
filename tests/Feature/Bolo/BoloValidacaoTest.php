<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('não permite criar bolo com nome vazio', function () {
    $data = [
        'nome' => '',
        'peso' => 1000,
        'valor' => 50.5,
        'quantidade_disponivel' => 5,
    ];

    post('/api/bolos', $data, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['nome']);
});

it('não permite criar bolo com peso negativo', function () {
    $data = [
        'nome' => 'Bolo Teste',
        'peso' => -500,
        'valor' => 50.5,
        'quantidade_disponivel' => 5,
    ];

    post('/api/bolos', $data, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['peso']);
});

it('não permite criar bolo com valor negativo', function () {
    $data = [
        'nome' => 'Bolo Teste',
        'peso' => 1000,
        'valor' => -20,
        'quantidade_disponivel' => 5,
    ];

    post('/api/bolos', $data, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['valor']);
});

it('não permite criar bolo com quantidade negativa', function () {
    $data = [
        'nome' => 'Bolo Teste',
        'peso' => 1000,
        'valor' => 20,
        'quantidade_disponivel' => -1,
    ];

    post('/api/bolos', $data, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['quantidade_disponivel']);
});

it('não permite criar bolo com email inválido', function () {
    $data = [
        'nome' => 'Bolo Teste',
        'peso' => 1000,
        'valor' => 20,
        'quantidade_disponivel' => 3,
        'emails_interessados' => ['invalido-email'],
    ];

    post('/api/bolos', $data, ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['emails_interessados.0']);
});
