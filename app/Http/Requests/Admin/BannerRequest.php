<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255', 'in:' . implode(',', config('banner.types'))],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg'],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules["$locale.title"] = ['required', 'string', 'max:255'];
            $rules["$locale.content"] = ['required', 'string'];
            $rules["$locale.link"] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }
}
