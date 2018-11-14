<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'cidade', 'nome', 'nascimento', 'rg', 'cpf', 'endereco', 'bairro', 'cep',
        'telefone', 'telefone_emergencia', 'nome_do_pai', 'nome_da_mae', 'pessoa_emergencia',
        'convenio_medico', 'filhos', 'irmaos', 'sexo', 'estado_civil', 'mora_com_os_pais', 'inativo',
    ];

    public function anamneses(){
        return $this->belongsTo(Anamnese::class);
    }

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_pessoas');
    }
}