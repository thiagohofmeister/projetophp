<?php

namespace forum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
            'nome' => 'required',
            'descricao' => 'required',
            'data_insc_inicio' => 'required',
            'data_insc_fim' => 'required',
            'data_rea_inicio' => 'required',
            'data_rea_fim' => 'required',
            'data_exi_inicio' => 'required',
            'data_exi_fim' => 'required',
            'foto_capa' => 'file'
        ];
    }

    public function messages()
    {
        return [
            'data_insc_inicio.required' => "O campo data inicial de inscrição é obrigatório",
            'data_insc_fim.required' => "O campo data final de inscrição é obrigatório",
            'data_rea_inicio.required' => "O campo data inicial de realização é obrigatório",
            'data_rea_fim.required' => "O campo data final de realização é obrigatório",
            'data_exi_inicio.required' => "O campo data inicial de exibição é obrigatório",
            'data_exi_fim.required' => "O campo data final de exibição é obrigatório",
            'required' => "O campo :attribute é obrigatório.",
            'numeric' => "O campo :attribute só aceita números."
        ];
    }
}
