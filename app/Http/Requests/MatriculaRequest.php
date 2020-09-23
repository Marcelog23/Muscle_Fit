<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
            'aluno_id' => 'required',
            'plano_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'aluno_id.required' => 'O campo Aluno é Obrigatório.',
            'plano_id.required' => 'O campo Plano é Obrigatório.',
        ];
    }
}
