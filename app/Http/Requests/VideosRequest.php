<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class VideosRequest extends FormRequest
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
            'titulo' => ['required', 'min:4'],
            'descricao' => ['required', 'min:4'],
            'url' => ['required', 'min:5']
        ];
    }

    protected function prepareForValidation()
    {

        $this->merge(
            [
                'categoriaId' => empty($this->get("categoriaId")) ? 1 : $this->get("categoriaId")
            ]
        );
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'Falha na validação dos dados',
                'data' => $validator->errors()
            ]
        ));
    }

    public function messages()
    {
        return [
            'titulo.required' => "O campo 'Titulo' é obrigatório",
            'titulo.min' => "O campo 'Titulo' precisa ter pelo menos 4 caracteres",

            'descricao.required' => "O campo 'Descricao' é obrigatório",
            'descricao.min' => "O campo 'Descricao' precisa ter pelo menos 4 caracteres",

            'url.required' => "O campo 'URL' é obrigatório",
            'url.min' => "O campo 'Url' precisa ter pelo menos 5 caracteres",
        ];
    }

}
