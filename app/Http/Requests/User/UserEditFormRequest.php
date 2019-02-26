<?php

namespace App\Http\Requests\Turma;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TurmaCreateEditFormRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'nick'                  => 'required|regex:/^[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:5,100',
            'email'                 => 'required|string|email|max:255|unique:users,email,'.$this->id_user.'|',
            'nome'                  => 'required|regex:/^[A-Za-z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/|between:3,100',

            'usuario'                  => 'sometimes|nullable|string|max:255',
            'password'                 => 'sometimes|nullable|string|min:5',
            'confirm_password'         => 'sometimes|required_with:password|same:password',
        ];
    }

    public function messages(){
        return[

        ];
    }
}