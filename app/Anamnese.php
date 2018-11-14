<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    protected $table = "anamneses";
    protected $fillable = [
        'possui_doenca', 'toma_medicacao', 'alergia_medicacao', 'peso', 'altura',
        'fumante', 'cirurgia', 'dor_muscular', 'dor_ossea', 'dor_articular',
        'atestado', 'observacao', 'pessoa_id',
    ];

    public function pessoa(){
        return $this->hasOne(Pessoa::class);
    }

    public function doencas(){
        return $this->BelongsToMany(Doenca::class, 'anamseases_doencas');
    }
}
