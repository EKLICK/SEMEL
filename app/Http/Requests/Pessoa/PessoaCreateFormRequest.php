<?php

namespace App\Http\Requests\Pessoa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PessoaCreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,50',
            'nascimento'            => 'required|date-format:d/m/Y',
            'sexo'                  => ['required', Rule::in(['M','F'])],
            'rg'                    => 'sometimes|nullable|max:13|min:6',
            'cpf'                   => 'sometimes|nullable|digits:14|unique:pessoas|unique:professores|',
            'cpf_responsavel'       => 'sometimes|nullable|digits:14',
            'cidade'                => 'regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'rua'                   => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'numero_endereco'       => 'sometimes|nullable|digits_between:0,5',
            'bairro'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|max:100',
            'cep'                   => 'sometimes|nullable|digits:10',
            'telefone'              => 'sometimes|nullable|digits_between:8, 16',
            'telefone_emergencia'   => 'sometimes|nullable|digits:digits_between:8, 16',
            'nome_do_pai'           => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'nome_da_mae'           => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'pessoa_emergencia'     => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'filhos'                => 'digits_between:0,4',
            'irmaos'                => 'digits_between:0,4',
            'estado_civil'          => ['sometimes','nullable', Rule::in(['Casado', 'Solteiro'])],
            'mora_com_os_pais'      => ['sometimes','nullable', Rule::in(['1', '2']),],

            'toma_medicacao'        => ['sometimes','nullable', Rule::in(['1', '2']),],
            'alergia_medicacao'     => ['sometimes','nullable', Rule::in(['1', '2']),],
            'fumante'               => ['sometimes','nullable', Rule::in(['1', '2']),],
            'cirurgia'              => ['sometimes','nullable', Rule::in(['1', '2']),],
            'dor_ossea'             => ['sometimes','nullable', Rule::in(['1', '2']),],
            'dor_muscular'          => ['sometimes','nullable', Rule::in(['1', '2']),],
            'dor_articular'         => ['sometimes','nullable', Rule::in(['1', '2']),],
            'doencas_id'            => 'sometimes|nullable|integer|exists:doencas,id',
        ];
    }

    public function messages(){
        return[
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 e 50 caracteres!',

            'nascimento.required' => 'O campo nascimento é de preenchimento obrigatório',
            'nascimento.date' => 'Insira uma data sem letras',

            'sexo.required' => 'O campo sexo é de preencimento obrigatório',

            'rg.max:' => 'O rg deve ter entr 6 e 13 caracteres!',

            'cpf.digits' => 'Insira um CPF de 11 caracteres!',
            'cpf.unique' => 'CPF já cadastrado no sistema!',

            'cpf_responsavel.digits' => 'Insira um CPF de 11 caracteres!',

            'cep.digits' => 'Insira um cep válido!',

            'bairro.max' => 'Insira um bairro válido!',
            'bairro.regex' => 'Não insira caracteres especiais no bairro',

            'rua.max' => 'Insira uma rua válida!',
            'rua.regex' => 'Não insira caracteres especiais na rua',

            'numero_endereco.digits_between' => 'Insira um número com no máximo 5 dígitos!',

            'telefone.digits_between' => 'Insira um telefone válido!',
            'telefone_emergencia.digits_between' => 'Insira um telefone válido!',

            'nome_do_pai.regex' => 'Insira o nome do pai sem caractéres especiais!',
            'nome_do_pai.between' => 'O nome do nome do pai deve estar entre 3 e 100 caracteres!',

            'nome_da_mae.regex' => 'Insira o nome da mãe sem caractéres especiais!',
            'nome_da_mae.between' => 'O nome da mãe deve estar entre 3 e 100 caracteres!',

            'pessoa_emergencia.regex' => 'Insira o nome da pessoa de emergência sem caractéres especiais!',
            'pessoa_emergencia.between' => 'Insira o nome da pessoa de emergência entre 3 e 100 caracteres!',

            'filhos.digits_between' => 'É permitido somente 4 digitos para quantidade de filhos',
            
            'irmaos.digits_between' => 'É permitido somente 4 digitos para quantidade de irmãos',
        ];
    }
}
