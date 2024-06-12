<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 
        'data_de_nascimento', 
        'sexo', 
        'estado_civil', 
        'nacionalidade', 
        'naturalidade', 
        'cpf', 
        'passaporte',  
        'nome_do_pai', 
        'nome_da_mae', 
    ];
    public $timestamps = false; 

    public function contato()
    {
        return $this->hasOne(Contato::class ,'id_usuario');
    }
    public function endereco()
    {
        return $this->hasOne(Endereco::class ,'id_usuario');
    }
    public function formacao()
    {
        return $this->hasOne(Formacao::class ,'id_usuario');
    }
    public function profissao()
    {
        return $this->hasOne(Profissao::class ,'id_usuario');
    }
}
