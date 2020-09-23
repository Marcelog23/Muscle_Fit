<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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

            'genr_aluno' => 'required',
            'nome_aluno' => 'required',
            'data_nasc'  => 'required|date',
            'endr_aluno' => 'required',
            'email_aluno'=> 'required|email',
            'cep_aluno'  => 'required',
            'numr_endr'  => 'required',
            'telf_aluno' => 'required',
            'cpf_aluno'  => "required|unique:alunos,cpf_aluno,$id",
            'rg_aluno'   => "required|unique:alunos,rg_aluno,$id",
            'objt_aluno' => 'required',
            'cidade_id'  => 'required',

        ];
    }

    public function messages()
    {
        return [
            'genr_aluno.required'  => 'O campo Obrigatório.',
            'nome_aluno.required'  => 'O campo Nome é Obrigatório.',
            'data_nasc.required'   => 'O campo Obrigatório.',
            'endr_aluno.required'  => 'O campo Endereço é Obrigatório.',
            'email_aluno.required' => 'O campo E-amil é  Obrigatório.',
            'cep_aluno.required'   => 'O campo CEP é Obrigatório.',
            'numr_endr.required'   => 'O campo Obrigatório.',
            'telf_aluno.required'  => 'O campo Obrigatório.',
            'cpf_aluno.required'   => 'O campo CPF é Obrigatório.',
            'rg_aluno.required'    => 'O campo RG é Obrigatório.',
            'objt_aluno.required'  => 'O campo Objetivo é Obrigatório.',
            'cidade_id.required'   => 'O campo Cidade é Obrigatório.',
        ];
    }


}
