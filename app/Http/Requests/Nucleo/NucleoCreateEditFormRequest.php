<?php

namespace App\Http\Requests\Nucleo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NucleoCreateEditFormRequest extends FormRequest
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
            'nome'                  => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'inativo'               => ['required', Rule::in(['1', '2']),],
            'bairro'                => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|max:100',
            'rua'                   => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'numero_endereco'       => 'required|digits_between:0,5',
            'cep'                   => 'required|digits:10',
            'descricao'             => 'sometimes|nullable|between:5,100',
        ];
    }

    public function messages(){
        return[
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 ou 100 caracteres!',

            'inativo.required' => 'O campo inativo é de preenchimento obrigatório!',

            'bairro.required' => 'O campo bairro é de preenchimento obrigatório!',
            'bairro.max' => 'Insira um bairro válido!',
            'bairro.regex' => 'Não insira caracteres especiais no bairro',

            'rua.required' => 'O campo rua é de preenchimento obrigatório!',
            'rua.max' => 'Insira uma rua válida!',
            'rua.regex' => 'Não insira caracteres especiais na rua',

            'numero_endereco.required' => 'O campo número é de preenchimento obrigatório!',
            'numero_endereco.digits_between' => 'Insira um número com no máximo 5 dígitos!',

            'cep.required' => 'O campo CEP é de preenchimento obrigatório!',
            'cep.digits' => 'Insira um cep válido!',

            'descricao.between' => 'O campo descrição deve estar entre 5 e 100 caracteres!',
        ];
    }
}
