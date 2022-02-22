<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = ['valor_pago', 'data', 'aluno_id'];


    public function aluno(){

        return $this->hasOne(Pagamento::class);
    }


    use HasFactory;
}
