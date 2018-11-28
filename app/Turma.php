<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{

    protected $fillable = [
        'nome', 'limite', 'nucleo_id',
    ];

    public function pessoas(){
        return $this->belongsToMany(Pessoa::class, 'turmas_pessoas');
    }

    public function nucleos(){
        return $this->BelongsTo(Nucleo::class);
    }

    public function professores(){
        return $this->belongsToMany(Professor::class, 'turmas_professores');
    } 
}
