<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Pagamento extends Model
{
    protected $fillable = ['valor_pago', 'data', 'aluno_id', 'periodo_fiscal', 'categoria', 'mensalidade'];


    public function aluno(){

        return $this->hasOne(Aluno::class)->withTrashed();
    }


    use HasFactory;
}
