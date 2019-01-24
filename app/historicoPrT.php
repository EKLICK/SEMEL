<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class historicoPrT extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'historico_professores_turmas';

    protected $fillable = [
        'professor_id','turma_id','inativo','comentario',
    ];
}
