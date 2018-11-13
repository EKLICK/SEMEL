<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = [
        'nome', 'limite', 'nucleo_id',
    ];

    public function pessoas(){
        return $this->hasMany(Pessoa::class);
    }

    public function nucleos(){
        return $this->BelongsTo(Nucleo::class);
    }

    public function professores(){
        return $THIS->BelongsToMany(Professor::class, 'turmas_professores');
    } 
}
