<?php

use App\Models\Bolo;

it('cria um bolo com sucesso usando a factory', function () {
    $bolo = Bolo::factory()->make();

    expect($bolo)->toBeInstanceOf(Bolo::class)
        ->and($bolo->nome)->not->toBeEmpty()
        ->and($bolo->peso)->toBeNumeric()
        ->and($bolo->valor)->toBeNumeric()
        ->and($bolo->quantidade_disponivel)->toBeInt();
});

it('faz cast correto de emails_interessados para array', function () {
    $emails = ['cliente1@email.com', 'cliente2@email.com'];

    $bolo = new Bolo([
        'emails_interessados' => $emails,
    ]);

    expect($bolo->emails_interessados)->toBeArray()
        ->toMatchArray($emails);
});

it('define atributos fillable corretamente', function () {
    $bolo = new Bolo();

    expect($bolo->getFillable())->toMatchArray([
        'nome',
        'peso',
        'valor',
        'quantidade_disponivel',
        'emails_interessados',
    ]);
});
