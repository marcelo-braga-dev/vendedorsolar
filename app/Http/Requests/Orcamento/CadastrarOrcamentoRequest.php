<?php

namespace App\Http\Requests\Orcamento;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarOrcamentoRequest extends FormRequest
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
            'id_kit' => 'required|integer|exists:kits,id',
            'cliente' => 'required',
            'cidade' => 'required|integer|exists:cidades_estados,id',
            'estrutura' => 'required',
            'tensao' => 'required',
            'orientacao' => 'required',
            'consumo' => 'required',
            'qtd_kits' => 'required|integer|min:1',
            'trafo' => 'nullable|integer|exists:trafos,id'
        ];
    }
}
