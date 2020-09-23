<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExercicioRequest extends FormRequest
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
            'codg_exrc' => 'required',
            'nome_exrc' => 'required',

        ];
    }


    public function messages()
    {
        return [
          'nome_exrc.required' => 'O campo Nome é Obrigatório'
        ];
    }
}
