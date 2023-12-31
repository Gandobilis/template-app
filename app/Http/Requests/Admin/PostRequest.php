<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg'],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale.title"] = ['required', 'string', 'max:255'];
            $rules["$locale.desc"] = ['required', 'string'];
            $rules["$locale.content"] = ['required', 'string'];
            $rules["$locale.slug"] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }
}
