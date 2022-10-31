<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoriaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "titulo" => ['required','min:2'],
            "cor" => ['required', 'min:2']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation erros',
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'titulo.required' => "O campo 'Titulo' é obrigatório",
            'titulo.min' => "O campo 'Titulo' precisa ter pelo menos 2 caracteres",

            'cor.required' => "O campo 'Cor' é obrigatório",
            'cor.min' => "O campo 'Cor' precisa ter pelo menos 2 caracteres",
        ];
    }

    public function valida()
    {
        
    }
}
