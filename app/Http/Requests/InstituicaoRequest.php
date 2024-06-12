<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'min:2', 'max:255'], 
            'data_de_fundacao' => ['required', 'date','before_or_equal:today'],
            'cnpj' => ['required', 'string','regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/'],
            'cpf_do_reitor' => ['required', 'string','regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/'],
            'cep' => ['required', 'string','regex:/^\d{5}-\d{3}$/'],
            'pais'=> ['required', 'string','max:255'],
            'estado'=> ['required', 'string','max:255'],
            'cidade'=> ['required', 'string','max:255'],
            'bairro'=> ['required', 'string','max:255'],
            'logradouro'=> ['required', 'string','max:255'],
            'numero'=> ['required', 'string','max:20'],
            'complemento'=> ['nullable', 'string','max:255'],
            'fone_de_contato' => ['required', 'string'],
            'fone_comercial' => ['required', 'string'],
            'ramal'=> ['required', 'string'],
            'email'=> ['required', 'email'],
            'email_op'=> ['nullable', 'email']
        ];
    }
}
