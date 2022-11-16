<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuariosFormRequest extends FormRequest
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
            'email' => ['required'],
            'password'=>['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(responde()->json(
            [
                'success' => false,
                'message' => "Dados inválidos",
                'data' => $validator->errors()
            ]
        ));
    }

    public function messages()
    {
        return [
            'email.required' => "O campo 'email' é obrigatório",
            'password.required' => "O campo 'password' é obrigatório"
        ];
    }
}
