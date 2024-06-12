<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnderecoRequest;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;


class EnderecoController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except('store', 'readAll', 'readOne', 'update');
    }

    public function store(EnderecoRequest $request, $id_usuario)
    {
        $usuario = Usuario::where('id_usuario', $id_usuario)->first();
        $endereco = Endereco::where('id_usuario', $id_usuario)->first();
        $dadosEndereco = $request->validated(); 
    
        if ($usuario && !$endereco) {
            $dadosEndereco['id_usuario'] = $usuario->id_usuario;
            Endereco::create($dadosEndereco); 
            return response()->json(['message' => 'Endereço adicionado com sucesso'], 200);
        } else {
            return response()->json(['message'=> 'Usuário não existe ou já existe endereço cadastrado!'], 400); 
        }
    }
    public function readAll()
    {
        $endereco = Endereco::all();
        return response()->json($endereco, 200);
    }
    public function readOne($id)
    {
        $endereco = Endereco::where('id_usuario', $id)->first();
        return response()->json($endereco, 200);
    }
    public function update(EnderecoRequest $request, $id_usuario)
    {
        $endereco = Endereco::where('id_usuario', $id_usuario)->first(); 
        $enderecoNovo = $request->validated();

        if($endereco){
            DB::table('enderecos')->where('id_usuario', $id_usuario)->update($enderecoNovo);
            return response()->json(['message'=> 'Endereço atualizado com sucesso!'], 200);
        } else {
            return response()->json(['message'=> 'Endereço correspondente não encontrado!'], 400);
        }
    }
}
