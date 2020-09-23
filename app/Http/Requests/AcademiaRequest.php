<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademiaRequest extends FormRequest
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
            'razao_social' => 'required|min:3|max:250',
            'nome_fant'    => 'required|min:3|max:250',
            'endr_acade'   => 'required|min:3|max:250',
            'telf_acade'   => 'required',
            'email_acade'  => 'required',
            'numr_acade'   => 'required',
            'cep_acade'    => 'required',
            'cnpj_acade'   => "required|unique:academias,cnpj_acade,$id",
            'cidade_id'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'razao_social.required' => 'O campo Razao Social é Obrigatório',
            'nome_fant.required'    => 'O campo Nome Fantasia é Obrigatório',
            'endr_acade.required'   => 'O campo Endereço é Obrigatório',
            'telf_acade.required'   => 'O campo Telefone é Obrigatório',
            'email_acade.required'  => 'O campo E-mail é Obrigatório',
            'numr_acade.required'   => 'O campo Número é Obrigatório',
            'cep_acade.required'    => 'O campo CEP é Obrigatório',
            'cnpj_acade.required'   => 'O campo CNPJ é Obrigatório',
            'cidade_id.required'    => 'O campo Cidade é Obrigatório',
        ];
    }
}
