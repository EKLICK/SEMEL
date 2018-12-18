<?php

namespace App\Http\Requests\Anamnese;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnamneseEditFormRequest extends FormRequest
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
            'peso'                  => 'required|numeric|digits:300',
            'altura'                => 'required|numeric|digits:4',
            'toma_medicacao'        => ['required', Rule::in(['1', '2']),],
            'alergia_medicacao'     => ['required', Rule::in(['1', '2']),],
            'fumante'               => ['required', Rule::in(['1', '2']),],
            'cirurgia'              => ['required', Rule::in(['1', '2']),],
            'dor_ossea'             => ['required', Rule::in(['1', '2']),],
            'dor_muscular'          => ['required', Rule::in(['1', '2']),],
            'dor_articular'         => ['required', Rule::in(['1', '2']),],
            'doencas_id'            => 'sometimes|nullable|integer|exists:doencas,id',
        ];
    }

    public function messages(){
        return [
            'peso.digits' => 'Insira um peso válido!',
            'altura.digits' => 'Insira uma altura válida!',
        ];
    }
}
