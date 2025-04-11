<?php

namespace App\Services;

use App\Models\Bolo;
use App\Jobs\EnviarEmailBoloDisponivel;

class BoloService
{
    // Cria um novo bolo e, se houver quantidade disponível, agenda o envio de e-mails para os interessados
    public function criarBoloComEmails(array $dados): Bolo
    {
        $bolo = Bolo::create([
            ...$dados,
            'emails_interessados' => $dados['emails_interessados'] ?? [],
        ]);

        // Se houver quantidade disponível e interessados, envia e-mails em lotes
        if ($bolo->quantidade_disponivel > 0 && !empty($dados['emails_interessados'])) {
            // Divide os e-mails em lotes de até 1000 para evitar sobrecarga
            collect($dados['emails_interessados'])
                ->chunk(1000)
                ->each(function ($chunk, $index) use ($bolo) {
                    // Agenda o envio do e-mail com um pequeno atraso entre os lotes
                    EnviarEmailBoloDisponivel::dispatch(
                        $bolo->nome,
                        $chunk->toArray()
                    )->delay(now()->addSeconds($index * 30));
                });
        }

        return $bolo;
    }

    // Busca um bolo específico pelo ID
    public function buscarPorId(int $id): Bolo
    {
        return Bolo::findOrFail($id);
    }

    // Atualiza os dados de um bolo específico pelo ID
    public function atualizarBolo(int $id, array $dados): Bolo
    {
        $bolo = Bolo::findOrFail($id);
        $bolo->update($dados);
        return $bolo;
    }

    // Deleta um bolo específico do banco de dados pelo ID
    public function deletarBolo(int $id): void
    {
        $bolo = Bolo::findOrFail($id);
        $bolo->delete();
    }
}
