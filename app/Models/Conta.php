<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    protected $table = 'contas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['numero', 'pessoa_id', 'saldo'];
}
