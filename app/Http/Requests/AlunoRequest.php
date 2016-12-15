<?php

namespace forum\Http\Requests;

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
        return [
            'ra' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ];
    }

    public function messages()
    {
        return [
            'data_nascimento.required' => "O campo data de nascimento é obrigatório",
            'email' => "Digite um e-mail válido.",
            'required' => "O campo :attribute é obrigatório.",
            'numeric' => "O campo :attribute só aceita números.",
            'same' => "O campo senha e o confirmação de senha devem ser iguais."
        ];
    }
}
