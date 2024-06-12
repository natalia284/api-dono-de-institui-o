<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormacaoRequest extends FormRequest
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
            'titulacao' => ['required','string'],
            'curso_maior_titulacao' => ['required','string'],
            'instituicao_maior_titulacao' => ['required','string'],
            'ano_de_conclusao' => ['required','integer'],
            'lattes' => ['required','string', 'unique:formacaos,lattes'],
            'data_de_inicio_pos' => ['nullable','date'],
            'data_de_fim_pos' => ['nullable','date'],
            'bolsa_de_pesquisa_concedida' => ['nullable','string'],
            'nome_da_bolsa' => ['nullable','string'],
            'grupo_de_pesquisa'=> ['nullable','string'],
            'nome_do_lider'=> ['nullable','string']
        ];
    }
     /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */

    public function withValidator($validator)
    {
        $this->obrigacao_pos_doutorado($validator);
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */

    public function obrigacao_pos_doutorado($validator)
    {
        $validator->sometimes('data_de_inicio_pos','required', function ($input){
            return $input->titulacao === 'POS DOUTORADO';  
        }); 

        $validator->sometimes('data_de_fim_pos','required', function ($input){
            return $input->titulacao === 'POS DOUTORADO';
        });

        $validator->sometimes('bolsa_de_pesquisa_concedida','required', function ($input){
            return $input->titulacao === 'POS_DOUTORADO';
        }); 

        $validator->sometimes('nome_da_bolsa','required', function ($input){
            return $input->titulacao === 'POS DOUTORADO' && $input->bolsa_de_pesquisa_concedida === 'SIM';
        });

        $validator->sometimes('grupo_de_pesquisa','required', function ($input){
            return $input->titulacao === 'POS DOUTORADO'; 
        });
        
        $validator->sometimes('nome_do_lider','required', function ($input){
            return $input->titulacao === 'POS DOUTORADO'; 
        });
    }
}
