<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nickname' => ['required', 'string', 'min:3', 'max:100', 'unique:users,nickname', 'regex:/^[^\s]+$/'],
            'email' => 'required|max:191|unique:users,email',
            'password' => 'required|min:6',
            'nome' => 'required|min:1|max:191'
        ];
    }
}
