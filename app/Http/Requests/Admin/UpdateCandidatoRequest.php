<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCandidatoRequest extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

        $candidatoId = $this->input('candidato_id');

        return [
            'residencia_id' => 'required|exists:residencias,id',
            'cpf' => [
                'required',
                Rule::unique('usuarios')->where(function($query) use($candidatoId){
                    return $query->where('id', '!=', $candidatoId);
                })
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        return [
            'residencia_id.required' => 'É necessário informar o código da residência!',
            'residencia_id.exists' => 'Este código não existe!',
            'cpf.required'  => 'É necessário informar o CPF do candidato!',
            'cpf.unique'  => 'Este CPF já está cadastrado!',
        ];
    }
}
