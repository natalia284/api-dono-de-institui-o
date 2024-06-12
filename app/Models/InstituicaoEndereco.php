<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituicaoEndereco extends Model
{
    use HasFactory;
    protected $table = 'Instituicao_END'; 
    protected $fillable = [
        'cnpj', 
        'cep', 
        'pais', 
        'estado', 
        'cidade', 
        'bairro', 
        'logradouro', 
        'numero', 
        'complemento', 
    ]; 
    public $timestamps = false; 

    public function instituicao_dados_basicos()
    {
        return $this->belongsTo(InstituicaoDadosBasicos::class, 'cnpj');
    }
}