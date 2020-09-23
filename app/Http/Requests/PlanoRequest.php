<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoRequest extends FormRequest
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
            'codg_plan' => 'required',
            'nome_plan' => 'required',
            'valr_plan' => 'required|numeric',
            'peri_plan' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'nome_plan.required' => 'O campo nome é Obrigatório',
            'valr_plan.required' => 'O campo Obrigatório',
            'peri_plan.required' => 'O campo Obrigatório',
        ];
    }
}
