<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituicaoDadosBasicos extends Model
{
    use HasFactory;
    protected $table = 'Instituicao_DB';
    protected $fillable = [
        'nome', 
        'data_de_fundacao', 
        'cnpj', 
        'cpf_do_reitor', 
    ]; 
    public $timestamps = false; 

    public function instituicao_endereco()
    {
        return $this->hasOne(InstituicaoEndereco::class, 'cnpj');
    }
    public function instituicao_contato()
    {
        return $this->hasOne(InstituicaoContato::class,'cnpj');
    }

}
