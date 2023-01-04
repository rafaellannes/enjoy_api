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
        $id = $this->user()->id ?? null;

        return  [
            'name' => ['required', 'min:3', 'max:100'],
            'email' => 'required|email|unique:clients,email,' . $id,
            'password' => ['sometimes', 'min:6', 'max:20'],
            'notificacao' => ['sometimes', 'boolean'],
            'descontos' => ['sometimes', 'boolean'],
            'sexo' => ['sometimes', 'in:M,F,O'],
            'data_nascimento' => ['sometimes', 'date'],
            'photo' => ['sometimes', 'image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'telefone' => ['nullable', 'min:10', 'max:191']
        ];
    }
}
