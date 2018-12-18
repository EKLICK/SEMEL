<?php

namespace App\Http\Requests\Doenca;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoencaCreateEditFormRequest extends FormRequest
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
            'nome'              => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'descricao'         => 'required',
        ];
    }

    public function messages(){
        return[
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'name.between' => 'Insira um nome entre 3 ou 100 caracteres!',

            'descricao.required' => 'O campo descrição é de preenchimento obrigatório!',
        ];
    }
}
