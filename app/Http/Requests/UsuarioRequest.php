<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $userId = $this->route('id');

        $rules = [
            'data_de_nascimento' => ['required', 'date', 'before_or_equal:today'],
            'sexo' => ['required', 'string'],
            'estado_civil' => ['nullable', 'string'],
            'nacionalidade' => ['required', 'string'],
            'nome_do_pai' => ['nullable', 'string'],
            'nome_da_mae' => ['required', 'string'],
        ];

        if (!$userId) {
            $rules['nome'] = ['required', 'string', 'min:2', 'max:255'];
            $rules['cpf'] = ['nullable', 'string', 'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', 'unique:usuarios,cpf'];
            $rules['passaporte'] = ['nullable', 'string', 'unique:usuarios,passaporte'];
            $rules['naturalidade'] = ['required', 'string'];
        }

        return $rules;
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    public function withValidator($validator)
    {
        $this->analisa_nacionalidade($validator);
    }

    /**
     * Apply custom conditional validations.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    public function analisa_nacionalidade($validator)
    { 
        $validator->sometimes('cpf', 'required', function ($input) {
            return $input->nacionalidade === 'BRASILEIRO' || $input->nacionalidade === 'NATURALIZADO'; 
        });

        $validator->sometimes('passaporte', 'required', function ($input) {
            return $input->nacionalidade === 'ESTRANGEIRO'; 
        });

        $validator->after(function ($validator) {
            $data = $validator->validated();
            if (!empty($data['cpf']) && !empty($data['passaporte'])) {
                $validator->errors()->add('cpf', 'Não é permitido ter CPF e passaporte ao mesmo tempo.');
                $validator->errors()->add('passaporte', 'Não é permitido ter CPF e passaporte ao mesmo tempo.');
            }
        });
    }
}
