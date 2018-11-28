<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doenca extends Model
{
    use softDeletes;

    protected $fillable = [
        'nome', 'descricao',
    ];

    public function anamneses(){
        return $this->belongsToMany(Anamnese::class);
    }
}
