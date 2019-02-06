<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quant extends Model
{
    protected $table = "quant_pessoa_turmas";

    protected $fillable = [
        'quantidade',
    ];
}
