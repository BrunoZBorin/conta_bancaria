<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['nome', 'cpf', 'endereco'];
}
