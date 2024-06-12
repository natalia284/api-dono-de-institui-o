<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\FormacaoController;
use App\Http\Controllers\IdentidadeController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ProfissaoController;
use App\Http\Controllers\TituloController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dados Pessoais

Route::get('/usuario', [UsuarioController::class,'readAll']); // OK
Route::get('/usuario/{id}', [UsuarioController::class,'readOne']); // OK
Route::post('/usuario', [UsuarioController::class,'store']); // OK 
Route::put('/usuario/{id}', [UsuarioController::class, 'update']); // OK

// Endereço 

Route::get('/endereco', [EnderecoController::class,'readAll']); // OK
Route::get('/endereco/{id}', [EnderecoController::class,'readOne']); // OK
Route::post('/endereco/{id}', [EnderecoController::class,'store']); // OK 
Route::put('/endereco/{id}', [EnderecoController::class,'update']); // OK

// Contato

Route::get('/contato', [ContatoController::class,'readAll']); // OK
Route::get('/contato/{id}', [ContatoController::class,'readOne']); // OK
Route::post('/contato/{id}', [ContatoController::class,'store']); // OK
Route::put('/contato/{id}', [ContatoController::class,'update']); // OK

// Profissão

Route::get('/profissao', [ProfissaoController::class,'readAll']); // OK 
Route::get('/profissao/{id}', [ProfissaoController::class, 'readOne']); // OK
Route::post('/profissao/{id}', [ProfissaoController::class,'store']); // OK
Route::put('/profissao/{id}', [ProfissaoController::class, 'update']); // OK 

// Formação

Route::get('/formacao', [FormacaoController::class, 'readAll']); // OK
Route::get('formacao/{id}', [FormacaoController::class, 'readOne']); // OK
Route::post('/formacao/{id}', [FormacaoController::class, 'store']); // OK
Route::put('/formacao/{id}', [FormacaoController::class,'update']); // OK

// Busca CPF

Route::get('/buscarCPF', [UsuarioController::class, 'buscaCPF']); 

// Busca Nome

Route::get('/buscarNome', [UsuarioController::class,'buscaNome']);

// Deletar Usuário Completo

Route::delete('/usuario/{id}', [UsuarioController::class,'destroy']);

// CRUD de Instituições 

Route::post('/instituicao/cadastrar', [InstituicaoController::class,'store']); 
Route::put('/instituicao/atualizar', [InstituicaoController::class,'update']);
Route::delete('/instituicao/excluir', [InstituicaoController::class,'destroy']); 
Route::get('/instituicoes/listar', [InstituicaoController::class,'read']);