<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ocorrencias extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $fillable = [
        'data',
        'hora',
        'posto',
        'id_topicos',
        'nome_salva_vidas',
        'nome_vitima',
        'grau',
        'sexo',
        'idade',
        'estado_civil',
        'profissao',
        'cidade',
        'uf',
        'endereco',
        'turista',
        'observacao',
    ];
    public function topicos(){

       return $this->belongsTo(Topicos::class);
        
    }
}
