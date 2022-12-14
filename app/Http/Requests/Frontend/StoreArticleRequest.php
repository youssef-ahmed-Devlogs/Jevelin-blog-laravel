<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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

        $rules = [
            'categories' => ['required'],
            'images' => ['required', 'max:500'],
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = ['required', 'min:30', 'max:255'];
            $rules[$locale . '.content'] = ['required', 'min:100', 'max:2000'];
        }

        return $rules;
    }
}
