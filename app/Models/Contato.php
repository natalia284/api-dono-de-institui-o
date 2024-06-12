<?php 
namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'email', 
        'email_sec', 
        'telefone_fixo', 
        'celular'
    ]; 

    public $timestamps = false; 

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'id_usuario');
    }
}