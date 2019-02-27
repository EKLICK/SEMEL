<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditFormRequest extends FormRequest{
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
            'email'                 => 'required|string|email|max:255|unique:users,email,'.$this->id.'|',

            'usuario'                  => 'sometimes|nullable|string|max:255',
            'password'                 => 'sometimes|nullable|string|min:5',
            'confirm_password'         => 'sometimes|nullable|required_with:password|same:password',
        ];
    }

    public function messages(){
        return[
            'nick.required' => 'fsfs',
            'email.required' => 'fsafsa',
            'email.unique' => 'sf',
            'confirm_password.required_with' => 'fsafs',
        ];
    }
}