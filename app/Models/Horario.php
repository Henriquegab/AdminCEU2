<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'dia', 'entrada', 'saida'];

    public function aluno(){

        return $this->hasOne(Aluno::class);
    }
}
