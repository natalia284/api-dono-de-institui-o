<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituicaoContato extends Model
{
    use HasFactory;
    protected $table = 'Instituicao_CO'; 
    protected $fillable = [
        'cnpj', 
        'fone_de_contato', 
        'fone_comercial', 
        'ramal',
        'email', 
        'email_op',
    ]; 
    public $timestamps = false; 

    public function instituicao_dados_basicos()
    {
        return $this->belongsTo(InstituicaoDadosBasicos::class, 'cnpj');
    }
}
