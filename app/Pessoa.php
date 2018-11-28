<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use softDeletes;

    protected $fillable = [
        'cidade', 'nome', 'nascimento', 'rg', 'cpf', 'endereco', 'bairro', 'cep',
        'telefone', 'telefone_emergencia', 'nome_do_pai', 'nome_da_mae', 'pessoa_emergencia',
        'convenio_medico', 'filhos', 'irmaos', 'sexo', 'estado_civil', 'mora_com_os_pais', 'inativo',
    ];

    public function anamneses(){
        return $this->hasMany(Anamnese::class, 'pessoas_id');
    }

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_pessoas');
    }
}
