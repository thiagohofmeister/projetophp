<?php

namespace forum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
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
            'nome' => 'required|min:3|string',
            'capacidade' => 'required|min:1|numeric',
            'adaptavel' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => "O campo :attribute é obrigatório.",
            'required.email' => "Preencha um e-mail válido.",
            'email' => "Preencha um e-mail válido.",
            'numeric' => "O campo :attribute só aceita números."
        ];
    }
}
