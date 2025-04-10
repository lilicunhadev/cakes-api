<?php

namespace App\Jobs;

use App\Mail\BoloDisponivelMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        foreach ($this->emails as $email) {
            Mail::to($email)->queue(new BoloDisponivelMail($this->nomeBolo));
        }
    }
}
