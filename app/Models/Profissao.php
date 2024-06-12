<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Profissao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario', 
        'vinculo', 
        'instituicao', 
        'situacao_funcional', 
        'cargo',
        'campus', 
        'centro', 
        'departamento', 
        'logradouro', 
        'numero', 
        'complemento', 
        'bairro', 
        'cep', 
        'pais', 
        'estado', 
        'municipio', 
        'fone_com',
        'ramal', 
        'preferencia_envio'
    ]; 

    public $timestamps = false; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'id_usuario');
    }

}