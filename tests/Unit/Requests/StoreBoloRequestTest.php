<?php

use App\Http\Requests\StoreBoloRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

uses(TestCase::class);

it('valida dados válidos corretamente no StoreBoloRequest', function () {
    $data = [
        'nome' => 'Bolo de Morango',
        'peso' => 1000,
        'valor' => 29.90,
        'quantidade_disponivel' => 5,
        'emails_interessados' => ['teste@example.com'],
    ];

    $request = new StoreBoloRequest();
    $rules = $request->rules();
    $validator = Validator::make($data, $rules);

    expect($validator->passes())->toBeTrue();
});

it('falha na validação se nome estiver vazio', function () {
    $data = ['nome' => '', 'peso' => 1000, 'valor' => 20, 'quantidade_disponivel' => 2];
    $request = new StoreBoloRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('nome'))->toBeTrue();
});

it('falha na validação com email inválido em emails_interessados', function () {
    $data = ['nome' => 'Bolo', 'peso' => 1000, 'valor' => 20, 'quantidade_disponivel' => 2, 'emails_interessados' => ['email_%_gmailcom']];
    $request = new StoreBoloRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->has('emails_interessados.0'))->toBeTrue();
});
