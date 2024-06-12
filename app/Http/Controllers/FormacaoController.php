<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormacaoRequest;
use App\Models\Formacao;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;


class FormacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except('store', 'readAll', 'readOne', 'update');
    }
    public function store(FormacaoRequest $request, $id_usuario)
    {
        $usuario = Usuario::where('id_usuario', $id_usuario)->first();
        $formacao = Formacao::where('id_usuario', $id_usuario)->first();
    
        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado!'], 404);
        }
        if ($formacao) {
            return response()->json(['message' => 'Usuário já possui formação cadastrada!'], 409);
        }
    
        $dados = $request->validated();
        $dados['id_usuario'] = $id_usuario;
    
        if ($dados['titulacao'] !== 'POS DOUTORADO') {
            $dados['data_de_inicio_pos'] = null;
            $dados['data_de_fim_pos'] = null;
            $dados['grupo_de_pesquisa'] = null;
            $dados['nome_do_lider'] = null;
        
            if ($dados['bolsa_de_pesquisa_concedida'] !== 'SIM') {
                $dados['nome_da_bolsa'] = null;
                $dados['bolsa_de_pesquisa_concedida'] = null;
            }
        }
        Formacao::create($dados);
        return response()->json(['message' => 'Formação adicionada com sucesso!'], 200);
    }
    public function readAll()
    {
        $formacao = Formacao::all();
        return response()->json($formacao, 200);
    }
    public function readOne($id_usuario)
    {
        $formacao = Formacao::where('id_usuario', $id_usuario)->first();
        if ($formacao) {
            return response()->json($formacao, 200);
        }
    }
    public function update(FormacaoRequest $request, $id_usuario)
    {
        $usuario = Usuario::where('id_usuario', $id_usuario)->first();
        $formacao = Formacao::where('id_usuario', $id_usuario)->first();
        $dados = $request->validated(); 

        if($usuario && $formacao)
        {
            if ($dados['titulacao'] !== 'POS DOUTORADO') {
                $dados['data_de_inicio_pos'] = null;
                $dados['data_de_fim_pos'] = null;
                $dados['grupo_de_pesquisa'] = null;
                $dados['nome_do_lider'] = null;
            
                if ($dados['bolsa_de_pesquisa_concedida'] !== 'SIM') {
                    $dados['nome_da_bolsa'] = null;
                    $dados['bolsa_de_pesquisa_concedida'] = null;
                }
            }
            if($dados['lattes'] !== $formacao['lattes']) {
                $verificaLattes = Formacao::where('lattes', $dados['lattes'])->first();
                if($verificaLattes){
                    return response()->json(['message' => 'O lattes já pertence a outro usuário!'], 400);
                } else {
                    $formacao['lattes '] = $dados['lattes']; 
                }
            }
        }

        DB::table('formacaos')->where('id_usuario', $id_usuario)->update($dados);
        return response()->json(['message' => 'Formação atualizada com sucessso!'], 200);
    }
}
