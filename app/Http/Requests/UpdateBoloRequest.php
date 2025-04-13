<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nome' => 'sometimes|required|string|max:255',
            'peso' => 'sometimes|required|integer|min:1',
            'valor' => 'sometimes|required|numeric|min:0',
            'quantidade_disponivel' => 'sometimes|required|integer|min:0',
            'emails_interessados' => 'nullable|array',
            'emails_interessados.*' => 'email',
        ];
    }
}
