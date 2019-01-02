<?php

namespace App\Http\Requests\Pessoa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PessoaCreateFromRequest extends FormRequest
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
            '3x4'                   => ['sometimes','nullable','regex:/\.((png)|(jpeg)|(img))+$/'],
            'matricula'             => ['sometimes','nullable','regex:/\.((png)|(jpeg)|(img))+$/'],
            'nome'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,50',
            'nascimento'            => 'required|date-format:d/m/Y',
            'sexo'                  => ['required', Rule::in(['M','F'])],
            'rg'                    => 'sometimes|nullable|max:13|min:6',
            'cpf'                   => 'sometimes|nullable|max:14|min:14|unique:pessoas|unique:professores|',
            'cpf_responsavel'       => 'sometimes|nullable|max:14|min:14',
            'cidade'                => 'regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'rua'                   => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'numero_endereco'       => 'sometimes|nullable|digits_between:0,5',
            'bairro'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|max:100',
            'cep'                   => 'sometimes|nullable|max:10|min:10',
            'telefone'              => 'sometimes|nullable|max:16|min:8',
            'telefone_emergencia'   => 'sometimes|nullable|max:16|min:8',
            'nome_do_pai'           => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'nome_da_mae'           => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'pessoa_emergencia'     => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ() ]+$/|between:3,100',
            'filhos'                => 'digits_between:0,4',
            'irmaos'                => 'digits_between:0,4',
            'estado_civil'          => ['sometimes','nullable', Rule::in(['Casado', 'Solteiro'])],
            'mora_com_os_pais'      => ['sometimes','nullable', Rule::in(['1', '2']),],

            'peso'                  => 'sometimes|nullable|numeric|max:300|min:0',
            'altura'                => 'sometimes|nullable|numeric|max:4|min:0',
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
            '3x4.regex' => 'O arquivo de perfil deve ser uma imagem ( .png | .jpeg | .img )',
            'matricula.regex' => 'O arquivo de matricula deve ser uma imagem ( .png | .jpeg | .img )',
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 e 50 caracteres!',

            'nascimento.required' => 'O campo nascimento é de preenchimento obrigatório',
            'nascimento.date_format' => 'Insira uma data sem letras',

            'sexo.required' => 'O campo sexo é de preencimento obrigatório',

            'rg.max:' => 'O rg deve ter entrw 6 e 13 digitos!',

            'cpf.max' => 'Insira um CPF de 11 caracteres!',
            'cpf.min' => 'Insira um CPF de 11 caracteres!',
            'cpf.unique' => 'CPF já cadastrado no sistema!',

            'cpf_responsavel.max' => 'Insira um CPF de 11 digitos!',
            'cpf_responsavel.min' => 'Insira um CPF de 11 digitos!',

            'bairro.max' => 'Insira um bairro válido!',
            'bairro.regex' => 'Não insira caracteres especiais no bairro',

            'cep.max' => 'Insira um CEP de 8 digitos!',
            'cep.min' => 'Insira um CEP de 8 digitos!',

            'rua.max' => 'Insira uma rua válida!',
            'rua.regex' => 'Não insira caracteres especiais na rua',

            'numero_endereco.digits_between' => 'Insira um número com no máximo 5 dígitos!',

            'telefone.max' => 'Insira um telefone válido!',
            'telefone.min' => 'Insira um telefone válido!',

            'telefone_emergencia.max' => 'Insira um telefone válido!',
            'telefone_emergencia.min' => 'Insira um telefone válido!',

            'nome_do_pai.regex' => 'Insira o nome do pai sem caractéres especiais!',
            'nome_do_pai.between' => 'O nome do nome do pai deve estar entre 3 e 100 caracteres!',

            'nome_da_mae.regex' => 'Insira o nome da mãe sem caractéres especiais!',
            'nome_da_mae.between' => 'O nome da mãe deve estar entre 3 e 100 caracteres!',

            'pessoa_emergencia.regex' => 'Insira o nome da pessoa de emergência sem caractéres especiais!',
            'pessoa_emergencia.between' => 'Insira o nome da pessoa de emergência entre 3 e 100 caracteres!',

            'filhos.digits_between' => 'É permitido somente 4 digitos para quantidade de filhos',
            
            'irmaos.digits_between' => 'É permitido somente 4 digitos para quantidade de irmãos',

            'peso.max' => 'Limite de máximo peso: 300Kg',
            'peso.min' => 'Limite de mínimo peso: 300Kg',

            'altura.max' => 'Limite de máximo altura: 4 metros',
            'altura.min' => 'Limite de mínimo altura: 4 metros',
        ];
    }
}
