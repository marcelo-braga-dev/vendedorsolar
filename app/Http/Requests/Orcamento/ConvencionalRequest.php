<?php

namespace App\Http\Requests\Orcamento;

use Illuminate\Foundation\Http\FormRequest;

class ConvencionalRequest extends FormRequest
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
        $rules = [
            'cliente' => 'required',
            'cidade' => 'required',
            'estrutura' => 'required',
            'tensao' => 'required',
            'orientacao' => 'required'
        ];

        if (!$this->get('consumo') && !$this->get('potencia')) {
            $rules = array_merge($rules, ['consumo' => 'required']);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'consumo.required' => 'Insira o consumo para dimensionamento.',
            'body.required' => 'A message is required',
        ];
    }
}
