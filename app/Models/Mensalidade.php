<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{   
    protected $fillable = ['categoria', 'preco'];
    use HasFactory;
}
