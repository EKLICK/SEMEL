<?php

namespace App\Http\Requests\Professor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlunoProcurarFromRequest extends FormRequest
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
            'telefone'              => 'sometimes|nullable|max:16|min:8',
        ];
    }

    public function messages(){
        return[
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 e 50 caracteres!',

            'de.date_format' => 'Insira uma data sem letras',

            'ate.date_format' => 'Insira uma data sem letras',

            'telefone.max' => 'Insira um telefone válido!',
            'telefone.min' => 'Insira um telefone válido!',
        ];
    }
}
