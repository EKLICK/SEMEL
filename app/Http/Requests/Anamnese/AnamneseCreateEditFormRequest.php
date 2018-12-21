<?php

namespace App\Http\Requests\Anamnese;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnamneseCreateEditFormRequest extends FormRequest
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
            'peso'                  => 'required|numeric|max:300',
            'altura'                => 'required|numeric|max:4',
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
            'peso.required' => 'O campo peso é de preenchimento obrigatório!',
            'peso.digits' => 'Insira um peso válido!',

            'altura.required' => 'O campo altura é de preenchimento obrigatório!',
            'altura.digits' => 'Insira uma altura válida!',

            'toma_medicacao.required' => 'é necessario preencher se o usuário toma medicamentos no formulario',
            'alergia_medicacao.required' => 'é necessario preencher se o usuário possui alergia médica no formulario',
            'fumante.required' => 'é necessario preencher se o usuário fuma no formulario',
            'cirurgia.required' => 'é necessario preencher se o usuário já fez cirurgia no formulario',
            'dor_ossea.required' => 'é necessario preencher se o usuário possui dor ossea no formulario',
            'dor_muscular.required' => 'é necessario preencher se o usuário possui dor muscular no formulario',
            'dor_articular.required' => 'é necessario preencher se o usuário possui dor articular no formulario',
        ];
    }
}
