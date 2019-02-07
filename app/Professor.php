<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Professor extends model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = "professores";

    protected $fillable = [
        'nome', 'nascimento','matricula','telefone','cidade','bairro','rua', 
        'numero_endereco','complemento','cep','cpf','rg','user_id','curso','formacao','cref'
    ];

    public function user(){
        return $this->HasOne(User::class);
    }

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_professores')->withPivot('inativo')->withTimestamps();
    }
}
