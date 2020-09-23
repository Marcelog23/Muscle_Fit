<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedidasRequest extends FormRequest
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
            'codg_medd' => 'required',
            'data_coleta' => 'required',
            'peso_aluno' => 'required',
            'altr_aluno' => 'required',
            'cint_aluno' => 'required',
            'qudr_aluno' => 'required',
            'abdm_aluno' => 'required',
            'coxa_dirt' => 'required',
            'coxa_esqr' => 'required',
            'bicp_dirt' => 'required',
            'bicp_esqr' => 'required',
            'ante_brco_dirt' => 'required',
            'ante_brco_esqr' => 'required',
            'pantr_esqr' => 'required',
            'pantr_dirt' => 'required',
            'personal_id' => 'required',
            'matricula_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'peso_aluno.required' => 'O campo Obrigatório',
            'altr_aluno.required' => 'O campo Obrigatório',
            'cint_aluno.required' => 'O campo Obrigatório',
            'qudr_aluno.required' => 'O campo Obrigatório',
            'abdm_aluno.required' => 'O campo Obrigatório',
            'coxa_dirt.required'  => 'O campo  Obrigatório',
            'coxa_esqr.required'  => 'O campo Obrigatório',
            'bicp_dirt.required'  => 'O campo Obrigatório',
            'bicp_esqr.required'  => 'O campo Obrigatório',
            'ante_brco_dirt.required' => 'O campo Obrigatório',
            'ante_brco_esqr.required' => 'O campo Obrigatório',
            'pantr_esqr.required'  => 'O campo Obrigatório',
            'pantr_dirt.required'  => 'O campo Obrigatório',
            'personal_id.required' => 'O campo Obrigatório',
            'matricula_id.required'    => 'O campo Obrigatório'
        ];
    }
}
