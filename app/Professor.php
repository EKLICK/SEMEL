<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Professor extends model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use softDeletes;

    protected $table = "professores";

    protected $fillable = [
        'nome', 'matricula', 'telefone', 'email', 'cpf', 'rg','user_id',
    ];

    public function users(){
        return $this->HasOne(User::class);
    }

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_professores');
    }
}
