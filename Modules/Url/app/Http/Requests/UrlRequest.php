<?php

namespace Modules\Url\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route()->url;
        $rules = [
            'title' => 'max:255',
            'back_half' => 'unique:urls,back_half|regex:#^[a-zA-Z0-9]+$#',
            'long_url' => 'required|url|string|max:255|url',
            'user_id' => ['required','integer', function($attribute, $value, $fail){
                if ($value == 0){
                    $fail(__('url::validation.select'));
                }
            }]
        ];
        if (!empty($id)){
            $rules['back_half'] = 'unique:urls,back_half,'.$id;
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'required' => __('url::validation.required'),
            'unique' => __('url::validation.unique'),
            'max' => __('url::validation.max'),
            'integer' => __('url::validation.integer'),
            'url' => __('url::validation.url'),
            'regex' => __('url::validation.regex')
        ];
    }

    public function attributes()
    {
        return [
            'long_url' => __('url::validation.attributes.long_url'),
            'back_half' => __('url::validation.attributes.back_half'),
            'title' => __('url::validation.attributes.title'),
            'user_id' => __('url::validation.attributes.user_id'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
