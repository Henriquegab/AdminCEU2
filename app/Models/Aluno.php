<?php

namespace App\Models;
use App\Models\Categoria;
use App\Models\Pagamento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'cpf', 'nascimento', 'pai', 'mae', 'endereco', 'numero','inicio', 'termino', 'telefone', 'modalidade', 'data', 'observacao', 'data_atestado', 'categoria_id'];
    use HasFactory;


    public function categoria(){

        return $this->belongsTo(Categoria::class);
    }

    public function pagamento(){

        return $this->belongsTo(Pagamento::class);
    }
}
