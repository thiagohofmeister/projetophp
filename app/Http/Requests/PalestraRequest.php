<?php

namespace forum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PalestraRequest extends FormRequest
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
            'titulo' => 'required|min:3|string',
            'data' => 'required',
            'hora' => 'required',
            'duracao' => 'required',
            'foto_capa' => 'file',
            'descricao' => 'required',
            'conteudos' => 'required'
        ];
    }
    
    /*public function messages()
    {
        return [
            'required' => "O campo :attribute é obrigatório.",
            'numeric' => "O campo :attribute só aceita números."
        ];
    }*/
}
