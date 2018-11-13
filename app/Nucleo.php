<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nucleo extends Model
{
    protected $fillable = [
        'nome', 'bairro',
    ];

    public function turmas(){
        return $this->HasOne(Turma::class);
    }
}
