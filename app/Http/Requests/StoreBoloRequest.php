<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoloRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'peso' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'quantidade_disponivel' => 'required|integer|min:0',
            'emails_interessados' => 'nullable|array',
            'emails_interessados.*' => 'email',
        ];
    }
}
