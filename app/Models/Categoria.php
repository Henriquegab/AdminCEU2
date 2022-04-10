<?php

namespace App\Models;

use App\Models\Aluno;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['categoria', 'preco'];

    public function aluno(){

        return $this->hasOne(Aluno::class);
    }
    


    use HasFactory;
}
