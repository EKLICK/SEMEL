<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Pessoa extends model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
