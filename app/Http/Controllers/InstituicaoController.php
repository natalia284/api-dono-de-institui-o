<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituicaoRequest;
use App\Models\Identidade;
use App\Models\InstituicaoContato;
use App\Models\InstituicaoDadosBasicos;
use App\Models\InstituicaoEndereco;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class InstituicaoController extends Controller
{
    public function __construct()
    {
        $this->middleware("web")->except('store', 'update', 'destroy', 'read');
    }
    public function store(InstituicaoRequest $request)
    {
        $validated = $request->validated(); 

        $existeUsuario = Identidade::where('cpf', $validated['cpf_do_reitor'])->first();

        $existeCnpj = InstituicaoDadosBasicos::where('cnpj', $validated['cnpj'])->first(); 

        if ($existeCnpj) {
            return response()->json(['error' => 'Instituição já cadastrada no sistema.'], 400); 
        } 

        DB::beginTransaction();

        try {
            if($existeUsuario){
                $dadosBasicos = InstituicaoDadosBasicos::create([
                    'nome'=> $validated['nome'],
                    'data_de_fundacao'=> $validated['data_de_fundacao'],
                    'cnpj'=> $validated['cnpj'],
                    'cpf_do_reitor'=> $validated['cpf_do_reitor']
                ]);
            } else {
                return response()->json(['error'=> 'CPF do reitor é inválido!'], 400);
            }

            if(!$dadosBasicos){
                throw new \Exception('Falha ao criar os dados básicos');
            }

            $endereco = InstituicaoEndereco::create([
                'cnpj'=> $dadosBasicos->cnpj,
                'cep'=> $validated['cep'],
                'pais'=> $validated['pais'],
                'estado'=> $validated['estado'],
                'cidade'=> $validated['cidade'],
                'bairro'=> $validated['bairro'],
                'logradouro'=> $validated['logradouro'],
                'numero'=> $validated['numero'],
                'complemento'=> $validated['complemento']
            ]);

            $contato = InstituicaoContato::create([
                'cnpj'=> $dadosBasicos->cnpj,
                'fone_de_contato'=> $validated['fone_de_contato'],
                'fone_comercial'=> $validated['fone_comercial'],
                'ramal'=> $validated['ramal'],
                'email'=> $validated['email'],
                'email_op'=> $validated['email_op']
            ]);  

            DB::commit(); 

            return response()->json(['message' => 'Instituição cadastrada com sucesso!'], 200);  

        }catch(\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'Erro ao criar registro: ' . $e->getMessage()], 500);
        }
    }

    public function update(InstituicaoRequest $request)
    {
        $validated = $request->validated(); 
        DB::beginTransaction();

        try {

            $dadosBasicos = InstituicaoDadosBasicos::where('cnpj', $request->cnpj)->first(); 

            if ($dadosBasicos){
                DB::table('Instituicao_DB')->where('cnpj', $request->cnpj)->update([
                    'nome' => $validated['nome'],
                    'data_de_fundacao' => $validated['data_de_fundacao'],
                    'cpf_do_reitor' => $validated['cpf_do_reitor']
                ]); 
            } else {
                return response()->json(['message' => 'Instituição não existe!'], 500);
            }

            $endereco = InstituicaoEndereco::where('cnpj', $request->cnpj)->first(); 

            if ($endereco){
                DB::table('Instituicao_END')->where('cnpj', $request->cnpj)->update([
                    'cep' => $validated['cep'],
                    'pais' => $validated['pais'],
                    'estado' => $validated['estado'],
                    'cidade' => $validated['cidade'],
                    'bairro' => $validated['bairro'],
                    'logradouro' => $validated['logradouro'],
                    'numero' => $validated['numero'],
                    'complemento' => $validated['complemento']
                ]); 
            }

            $contato = InstituicaoContato::where('cnpj', $request->cnpj)->first();
            
            if ($contato){
                DB::table('Instituicao_CO')->where('cnpj', $request->cnpj)->update([
                    'fone_de_contato' => $validated['fone_de_contato'],
                    'fone_comercial' => $validated['fone_comercial'],
                    'ramal' => $validated['ramal'],
                    'email' => $validated['email'],
                    'email_op' => $validated['email_op']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Instituição atualizada com sucesso!'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar registro: ' . $e->getMessage()], 500);
        }
    }
    public function destroy(Request $request)
    {
        $cnpj = $request->input('cnpj'); 
        DB::beginTransaction();

        try {
            DB::table('Instituicao_END')->where('cnpj', $cnpj)->delete();
            DB::table('Instituicao_CO')->where('cnpj', $cnpj)->delete();
            $existeDados = DB::table('Instituicao_DB')->where('cnpj', $cnpj)->delete();

            if(!$existeDados) {
                return response()->json(['error'=> 'Instituição não existe na base de dados.'], 500);
            }
                
            DB::commit();
            return response()->json(['message'=> 'Instituição excluída com sucesso!'], 200);

        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error'=> 'Erro no registro'. $e->getMessage()], 500);
        }
    }
    public function read(){

        $jsonCompleto = DB::table('Instituicao_DB')
              ->join('Instituicao_END', 'Instituicao_DB.cnpj', '=', 'Instituicao_END.cnpj')
              ->join('Instituicao_CO', 'Instituicao_DB.cnpj', '=', 'Instituicao_CO.cnpj')
              ->select(
                  'Instituicao_DB.nome',
                  'Instituicao_DB.data_de_fundacao',
                  'Instituicao_DB.cnpj',
                  'Instituicao_DB.cpf_do_reitor',
                  'Instituicao_END.cep',
                  'Instituicao_END.pais',
                  'Instituicao_END.estado',
                  'Instituicao_END.cidade',
                  'Instituicao_END.bairro',
                  'Instituicao_END.logradouro',
                  'Instituicao_END.numero',
                  'Instituicao_END.complemento',
                  'Instituicao_CO.fone_de_contato',
                  'Instituicao_CO.fone_comercial',
                  'Instituicao_CO.ramal',
                  'Instituicao_CO.email',
                  'Instituicao_CO.email_op'
              )->get();

        return response()->json($jsonCompleto);
    }
}

            

                

