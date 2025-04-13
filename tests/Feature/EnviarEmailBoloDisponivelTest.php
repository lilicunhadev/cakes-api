<?php

use App\Jobs\EnviarEmailBoloDisponivel;
use App\Models\Bolo;
use Illuminate\Support\Facades\Bus;
use function Pest\Laravel\postJson;

beforeEach(function () {
    Bus::fake();
});

it('despacha o job de envio de e-mails quando bolo tem interessados e quantidade disponível', function () {
    $data = [
        'nome' => 'Bolo de Teste',
        'peso' => 1000,
        'valor' => 50.0,
        'quantidade_disponivel' => 5,
        'emails_interessados' => ['teste1@exemplo.com', 'teste2@exemplo.com'],
    ];

    postJson('/api/bolos', $data)->assertCreated();

    Bus::assertDispatched(EnviarEmailBoloDisponivel::class, 1);
});

it('não despacha job se não houver interessados', function () {
    $data = [
        'nome' => 'Bolo Sem Emails',
        'peso' => 1000,
        'valor' => 60.0,
        'quantidade_disponivel' => 3,
        'emails_interessados' => [],
    ];

    postJson('/api/bolos', $data)->assertCreated();

    Bus::assertNotDispatched(EnviarEmailBoloDisponivel::class);
});

it('não despacha job se quantidade for zero', function () {
    $data = [
        'nome' => 'Bolo Zerado',
        'peso' => 1000,
        'valor' => 60.0,
        'quantidade_disponivel' => 0,
        'emails_interessados' => ['teste@exemplo.com'],
    ];

    postJson('/api/bolos', $data)->assertCreated();

    Bus::assertNotDispatched(EnviarEmailBoloDisponivel::class);
});
