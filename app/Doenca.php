<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doenca extends Model
{

    protected $fillable = [
        'nome', 'descricao',
    ];

    public function anamneses(){
        return $this->belongsToMany(Anamnese::class);
    }
}
