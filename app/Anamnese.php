<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anamnese extends Model
{
    use softDeletes;

    protected $table = "anamneses";
    protected $fillable = [
        'ano', 'pessoas_id', 'peso', 'altura', 'possui_doenca', 'toma_medicacao', 'alergia_medicacao',
        'fumante', 'cirurgia', 'dor_ossea', 'dor_muscular', 'dor_articular','atestado', 'observacao',
    ];

    public function pessoas(){
        return $this->belongsTo(Pessoa::class);
    }

    public function doencas(){
        return $this->belongsToMany(Doenca::class, 'anamneses_doencas');
    }
}
