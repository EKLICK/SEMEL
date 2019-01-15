<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Nucleo extends model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nome', 'cidade', 'bairro_id', 'rua', 'numero_endereco', 'cep', 'inativo', 'descricao',
    ];

    public function turmas(){
        return $this->HasMany(Turma::class);
    }

    public function bairro(){
        return $this->BelongsTo(Bairro::class);
    }
}
