<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Bairro extends model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nome'
    ];
}
