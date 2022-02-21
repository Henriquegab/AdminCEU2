<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'cpf', 'nascimento', 'pai', 'mae', 'endereco', 'numero', 'telefone', 'modalidade', 'data', 'observacao', 'data_atestado', 'categoria_id'];
    use HasFactory;
}
