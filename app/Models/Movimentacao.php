<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';
    protected $primaryKey = 'id';
    protected $fillable = ['conta_id', 'pessoa_id', 'valor'];
}
