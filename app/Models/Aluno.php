<?php

namespace App\Models;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'cpf', 'nascimento', 'pai', 'mae', 'endereco', 'numero','inicio', 'termino', 'telefone', 'modalidade', 'data', 'observacao', 'data_atestado', 'categoria_id'];
    use HasFactory;


    public function categorias(){

        return $this->hasMany(Categoria::class);
    }
}
