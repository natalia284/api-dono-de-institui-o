<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;


class ContatoController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except('store', 'readAll', 'readOne', 'update');
    }
    public function store(ContatoRequest $request, $id_usuario)
    {
        $usuario = Usuario::where('id_usuario', $id_usuario)->first();
        $contato = Contato::where('id_usuario', $id_usuario)->first();
        $dadosContato = $request->validated();

        if($usuario && !$contato){
            $dadosContato['id_usuario'] = $usuario->id_usuario;
            Contato::create($dadosContato);
            return response()->json(['message' => 'Contato adicionado com sucesso'], 200);
        } else {
            return response()->json(['message'=> 'Usuário não existe ou já existe contato cadastrado!'], 400);
        }
    }
    public function readAll()
    {
        $contato = Contato::all();
        return response()->json($contato);
    }
    public function readOne($id_usuario)
    {
        $contato = Contato::where('id_usuario', $id_usuario)->first();
        return response()->json($contato);
    }
    public function update(ContatoRequest $request, $id_usuario)
    {
        $contato = Contato::where('id_usuario', $id_usuario)->first();
        $contatoNovo = $request->validated();

        if($contato){
            unset($contatoNovo['email']); 
            DB::table('contatos')->where('id_usuario', $id_usuario)->update($contatoNovo);
            return response()->json(['message'=> 'Contato atualizado com sucesso!'], 200);
        } else {
            return response()->json(['message'=> 'Contato correspondente não encontrado!'], 400);
        }
        

        
    }

}