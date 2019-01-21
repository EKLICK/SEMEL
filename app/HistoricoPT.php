<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoPT extends Model
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'historico_pessoas_turmas';

    protected $fillable = [
        'nome', 'pessoa_id', 'turma_id', 'inativo',
    ];
}
