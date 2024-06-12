<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfissaoRequest extends FormRequest
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
            'vinculo' => ['required','string'],
            'instituicao'=> ['nullable','string'],
            'situacao_funcional' => ['nullable','string'],
            'cargo' => ['nullable','string'],
            'campus' => ['nullable','string'],
            'centro' => ['nullable','string'],
            'departamento' => ['nullable','string'],
            'logradouro' => ['required','string'],
            'numero' => ['required','string'],
            'complemento' => ['nullable','string'],
            'bairro' => ['required','string'],
            'cep' => ['required', 'string', 'regex:/^\d{2}\.\d{3}-\d{3}$/'],
            'pais' => ['required','string'],
            'estado' => ['required','string'],
            'municipio' => ['required','string'],
            'fone_com' => ['required','string'],
            'ramal' => ['nullable','string'],
            'preferencia_envio' => ['required','string']
        ]; 
    }
}
