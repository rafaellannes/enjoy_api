<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return  [
            'name' => ['required', 'min:3', 'max:100'],
            'email' => 'required|email|unique:clients,email,' . $this->user()->id,
            'password' => ['sometimes', 'min:6', 'max:80'],
            'notificacao' => ['required', 'boolean'],
            'descontos' => ['required', 'boolean'],
            'sexo' => ['required', 'in:M,F,O'],
            'data_nascimento' => ['required', 'date'],
        ];
    }
}
