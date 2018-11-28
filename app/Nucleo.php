<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nucleo extends Model
{
    use softDeletes;

    protected $fillable = [
        'nome', 'bairro',
    ];

    public function turmas(){
        return $this->HasMany(Turma::class);
    }
}
