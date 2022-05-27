<?php

namespace App\Http\Requests\Orcamento;

use Illuminate\Foundation\Http\FormRequest;

class DemandaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente' => 'required',
            'cidade' => 'required',
            'estrutura' => 'required',
            'tensao' => 'required',
            'orientacao' => 'required',
            'consumo_fora_ponta' => 'required',
            'consumo_ponta' => 'required',
            'concessionaria' => 'required',
        ];
    }
}
