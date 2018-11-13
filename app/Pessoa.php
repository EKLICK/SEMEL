<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nome, nascimento', 'sexo', 'rg', 'cpf', 'cidade', 'endereco', 'bairro',
        'cep', 'telefone', 'estado_civil', 'nome_do_pai', 'nome_da_mae', 'pessoa_emerncia',
        'telefone_emergencia', 'filhos', 'convenio_medico', 'irmaos', 'mora_com_os_pais', 'inativo',
    ];

    public function anamneses(){
        return $this->belongsTo(Anamnese::class);
    }

    public function turmas(){
        return $this->belongsToMany(Turma::class, 'turmas_pessoas');
    }
}
