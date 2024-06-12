<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario', 
        'rua',
        'numero', 
        'complemento', 
        'bairro',
        'cep', 
        'pais', 
        'estado', 
        'municipio'
    ];

    public $timestamps = false; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'id_usuario');
    }


}