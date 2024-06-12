<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rua' => ['required', 'string'],
            'numero'=> ['required','string'],
            'complemento' => ['nullable','string'],
            'bairro' => ['required','string'],
            'cep' => ['required', 'string', 'regex:/^\d{2}\.\d{3}-\d{3}$/'],
            'pais'=> ['required','string'],
            'estado'=> ['required','string'],
            'municipio' => ['required','string']
        ];
    }
}
