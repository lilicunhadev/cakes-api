<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'peso' => $this->peso,
            'valor' => $this->valor,
            'quantidade_disponivel' => $this->quantidade_disponivel,
            'emails_interessados' => $this->emails_interessados,
            'created_at' => $this->created_at,
        ];
    }
}
