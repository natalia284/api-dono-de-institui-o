<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissaoRequest;
use App\Models\Profissao;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class ProfissaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except('store', 'readAll', 'readOne', 'update');
    }

    public function store(ProfissaoRequest $request, $id_usuario)
    {
        $usuario = Usuario::where('id_usuario', $id_usuario)->first();
        $profissao = Profissao::where('id_usuario', $id_usuario)->first();
        $dadosProfissao = $request->validated();

        if($usuario && !$profissao){
            $dadosProfissao['id_usuario'] = $usuario->id_usuario; 
            Profissao::create($dadosProfissao);
            return response()->json(['message' => 'Profissão adicionada com sucesso'], 200);
        } else {
            return response()->json(['message'=> 'Usuário não existe ou já existe profissão cadastrada!'], 400);
        }
    }
    public function readAll()
    {
        $profissao = Profissao::all();
        return response()->json($profissao, 200);
    }
    public function readOne($id_profissao)
    {
        $profissao = Profissao::where('id_usuario', $id_profissao)->first();
        return response()->json($profissao, 200);
    }
    public function update(ProfissaoRequest $request, $id_usuario)
    {
        $profissao = Profissao::where('id_usuario', $id_usuario)->first();
        $profissaoNova = $request->validated();

        if($profissao){
            DB::table('profissaos')->where('id_usuario', $id_usuario)->update($profissaoNova);
            return response()->json(['message'=> 'Profissão atualizada com sucesso!'], 200);
        } else {
            return response()->json(['message'=> 'Profissão correspondente não encontrada!'], 400);
        }
    }


}
