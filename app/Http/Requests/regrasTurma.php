<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class regrasTurma extends FormRequest
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
            'nucleo_id' =>'required',
        ];
    }

    public function messages(){
        return [
            'nucleo_id.required' => 'A turma necessita obrigatoriamente de um núcleo!',
        ];
    }
}
