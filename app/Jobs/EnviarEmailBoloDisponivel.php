<?php

namespace App\Jobs;

use App\Mail\BoloDisponivelMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class EnviarEmailBoloDisponivel implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue, SerializesModels;

    public string $nomeBolo;
    public array $emails;

    /**
     * Create a new job instance.
     */
    public function __construct(string $nomeBolo, array $emails)
    {
        $this->nomeBolo = $nomeBolo;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $total = count($this->emails);
        Log::info("Iniciando envio do bolo '{$this->nomeBolo}' para {$total} interessados...");

        foreach ($this->emails as $email) {
            try {
                Mail::to($email)->queue(new BoloDisponivelMail($this->nomeBolo));
                Log::info("E-mail enviado para: {$email}");
            } catch (\Exception $e) {
                Log::error("Falha ao enviar para {$email}: " . $e->getMessage());
            }
        }

        Log::info("Job finalizado para {$total} e-mails (Bolo: {$this->nomeBolo})");
    }
}
