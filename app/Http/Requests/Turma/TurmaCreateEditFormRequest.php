<?php

namespace App\Http\Requests\Turma;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TurmaCreateEditFormRequest extends FormRequest
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
            'limite'                => 'required|integer|digits:100',
            'inativo'               => ['required', Rule::in(['1', '2']),],
            'horario_inicial'       => 'required|regex:/^[0-9AMP:]+$/|',
            'horario_final'         => 'required|regex:/^[0-9AMP:]+$/|',
            'data_semana'           => 'required|array|',
            'nucleo_id'             => 'required',
            'descricao'             => 'sometimes|nullable|between:5,100',
        ];
    }

    public function messages(){
        return[
            'nome.required' => 'O campo nome é de preenchimento obrigatório!',
            'nome.regex' => 'Insira um nome sem caractéres especiais!',
            'nome.between' => 'Insira um nome entre 3 ou 100 caracteres!',

            'limite.required' => 'O campo limite é de preenchimento obrigatório!',

            'inativo.required' => 'O campo inativo é de preenchimento obrigatório!',

            'horario_inicial.required' => 'O campo horário inicial é de preenchimento obrigatório!',
            'horario_inicial' => 'Digite um horário inicial válido!',

            'horario_final.required' => 'O campo horário final é de preenchimento obrigatório!',
            'horario_final' => 'Digite um horário final válido!',

            'data_semana.required' => 'O campo dias da semana é de preenchimento obrigatório!',

            'nucleo_id.required' => 'O campo núcleo é de preenchimento obrigatório!',

            'descricao.between' => 'O campo descrição deve estar entre 5 e 100 caracteres!',
        ];
    }
}
