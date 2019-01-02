<?php

namespace App\Http\Requests\Professor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessorProcurarFromRequest extends FormRequest
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
            'nome'                  => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',
            'matricula'             => 'sometimes|nullable|integer|unique:professores,matricula,'.$this->id.'|',
            'de'                    => 'sometimes|nullable|date-format:d/m/Y',
            'ate'                   => 'sometimes|nullable|date-format:d/m/Y',
            'bairro'                => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|max:100',
            'rua'                   => 'sometimes|nullable|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/',
            'telefone'              => 'sometimes|nullable|max:16|min:8',
            'email'                 => 'sometimes|nullable|string|email|max:255|unique:users,email,'.$this->id_user.'|',
        ];
    }

    public function messages(){
        return[
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 ou 100 caracteres!',

            'matricula.unique' => 'Número de matricula já cadastrada!',

            'de.date_format' => 'Insira uma data sem letras',
            'ate.date_format' => 'Insira uma data sem letras',

            'bairro.max' => 'Insira um bairro válido!',
            'bairro.regex' => 'Não insira caracteres especiais no bairro',

            'rua.max' => 'Insira uma rua válida!',
            'rua.regex' => 'Não insira caracteres especiais na rua',

            'telefone.max' => 'Insira um telefone válido!',
            'telefone.min' => 'Insira um telefone válido!',

            'email.unique' => 'Email já registrado!',
            'email.max' => 'O email deve ter no maximo 255 caractéres',
        ];
    }
}
