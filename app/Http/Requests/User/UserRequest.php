<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "image" => "mimes:png,jpg",
            "email" => "required|email|max:255|unique:users,email",
            "name" => "required|string|max:255",
            "password" => "required|string|min:8|max:128",
            'active' => 'boolean',
        ];
    }
}
