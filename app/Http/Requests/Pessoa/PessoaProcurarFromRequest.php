<?php

namespace App\Http\Requests\Pessoa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PessoaProcurarFromRequest extends FormRequest
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
            'nome'                  => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,50',
            'de'                    => 'sometimes|nullable|date-format:d/m/Y',
            'ate'                   => 'sometimes|nullable|date-format:d/m/Y',
            'sexo'                  => ['sometimes','nullable', Rule::in(['M','F'])],
            'rg'                    => 'sometimes|nullable|max:13|min:6',
            'cpf'                   => 'sometimes|nullable|max:14|min:14|unique:pessoas|unique:professores|',
            'rua'                   => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'bairro'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|max:100',
            'telefone'              => 'sometimes|nullable|max:16|min:8',
            'estado_civil'          => ['sometimes','nullable', Rule::in(['Casado', 'Solteiro'])],

        ];
    }

    public function messages(){
        return[
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 e 50 caracteres!',

            'de.date_format' => 'Insira uma data sem letras',

            'ate.date_format' => 'Insira uma data sem letras',

            'rg.max:' => 'O rg deve ter entrw 6 e 13 digitos!',

            'cpf.max' => 'Insira um CPF de 11 caracteres!',
            'cpf.min' => 'Insira um CPF de 11 caracteres!',
            'cpf.unique' => 'CPF já cadastrado no sistema!',

            'rua.max' => 'Insira uma rua válida!',
            'rua.regex' => 'Não insira caracteres especiais na rua',

            'bairro.max' => 'Insira um bairro válido!',
            'bairro.regex' => 'Não insira caracteres especiais no bairro',

            'telefone.max' => 'Insira um telefone válido!',
            'telefone.min' => 'Insira um telefone válido!',
        ];
    }
}
