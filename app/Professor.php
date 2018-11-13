<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = "professores";

    protected $fillable = [
        'nome', 'matricula', 'telefone', 'email', 'cpf', 'rg','user_id',
    ];
}
