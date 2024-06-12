<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Formacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario', 
        'titulacao', 
        'curso_maior_titulacao', 
        'instituicao_maior_titulacao', 
        'ano_de_conclusao', 
        'lattes', 
        'data_de_inicio_pos', 
        'data_de_fim_pos', 
        'bolsa_de_pesquisa_concedida',
        'nome_da_bolsa', 
        'grupo_de_pesquisa', 
        'nome_do_lider' 
    ]; 

    public $timestamps = false; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'id_usuario');
    }

}