<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
        $id = $this->route('id');

        return [

            'nome_pers'  => 'required',
            'data_nasc'  => 'required',
            'endr_pers'  => 'required',
            'numr_endr'  => 'required',
            'telf_pers'  => 'required',
            'cpf_pers'   => "required|unique:personals,cpf_pers,$id",
            'rg_pers'    => "required|unique:personals,rg_pers,$id",
            'forma_acad' => 'required',
            'cep_pers'   => 'required',
            'cidade_id'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome_pers.required'  => 'O campo Nome é Obrigatório',
            'data_nasc.required'  => 'O campo Obrigatório',
            'endr_pers.required'  => 'O campo Endereço é Obrigatório',
            'numr_endr.required'  => 'O campo Obrigatório',
            'telf_pers.required'  => 'O campo Telefone é Obrigatório',
            'cpf_pers.required'   => 'O campo CPF é Obrigatório',
            'cep_pers.required'   => 'O campo Obrigatório',
            'rg_pers.required'    => 'O campo RG é Obrigatório',
            'forma_acad.required' => 'O campo Obrigatório',
            'cidade_id.required'  => 'O campo Cidade é Obrigatório',
        ];
    }
}
