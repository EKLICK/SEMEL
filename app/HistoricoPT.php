<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HistoricoPT extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'historico_pessoas_turmas';

    protected $fillable = [
        'nome','pessoa_id','turma_id','inativo','comentario',
    ];
}
