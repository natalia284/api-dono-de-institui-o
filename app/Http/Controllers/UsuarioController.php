<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->except('store', 'readAll', 'readOne', 'update', 'readCPF', 'destroy');
    }

    public function store(UsuarioRequest $request)
    {
        Usuario::create($request->validated());
        
        return response()->json(['message' => 'Usuário salvo com sucesso'], 201);
    }
    public function readAll()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }
    public function readOne($id)
    {
        $usuario = Usuario::where('id_usuario', $id)->first();
        if($usuario){
            return response()->json($usuario, 200);
      
        } else {
            return response()->json(['message'=> 'Usuário não encontrado!'], 404);
        }
    }
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::where('id_usuario', $id)->first(); 
        if($usuario){
            $dados = $request->validated();
            unset($dados['nome'], $dados['cpf'], $dados['passaporte'], $dados['naturalidade']);
    
            DB::table('usuarios')->where('id_usuario', $id)->update($dados); 
            return response()->json(['message' => 'Usuário atualizado com sucesso'], 200);
        } else {
            return response()->json(['message'=> 'Usuário não encontrado!'], 404);
        }
    }
    
    public function buscaCPF(Request $request)
    {
        $cpf = $request->input('cpf');
    
        $normalizedCpf = str_replace(['.', '-', ' '], '', $cpf);
    
        $usuarios = Usuario::whereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') LIKE ?", ["%{$normalizedCpf}%"])
                     ->get();
    
        if ($usuarios->isEmpty()) {
            return response()->json(['message' => 'Nenhum usuário encontrado'], 404);
        }
    
        return response()->json($usuarios);
    }
    public function buscaNome(Request $request)
    {
        $nome = $request->input('nome');

        $usuarios = Usuario::whereRaw("LOWER(nome) LIKE LOWER(?)", ["%{$nome}%"])->get();

        if ($usuarios->isEmpty()) {
            return response()->json(['message' => 'Nenhum usuário encontrado'], 404);
        }
        return response()->json($usuarios);
    }
    public function destroy($id_usuario)
    {
        DB::beginTransaction();

        try {
            DB::table('contatos')->where('id_usuario', $id_usuario)->delete();
            DB::table('enderecos')->where('id_usuario', $id_usuario)->delete();
            DB::table('formacaos')->where('id_usuario', $id_usuario)->delete();
            DB::table('profissaos')->where('id_usuario', $id_usuario)->delete();
            $existeDados = DB::table('usuarios')->where('id_usuario', $id_usuario)->delete();

            if(!$existeDados) {
                return response()->json(['error'=> 'Usuário não existe na base de dados.'], 500);
            }
                
            DB::commit();
            return response()->json(['message'=> 'Usuário excluído com sucesso!'], 200);

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Erro no registro'. $e->getMessage()], 500);
        }
    }
}