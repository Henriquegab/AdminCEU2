<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodofiscal extends Model
{
    protected $fillable = ['data'];
    protected $table = 'periodofiscal';
    use HasFactory;
}
