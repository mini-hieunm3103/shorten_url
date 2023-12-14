<?php

namespace Modules\Tag\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route()->url;
        $rules = [
            'title' => 'required|max:255',
            'description' => '',
            'urls' => 'required',
            'user_id' => ['integer', function($attribute, $value, $fail){
                if ($value == 0){
                    $fail(__('tag::validation.select'));
                }
            }]
        ];
        return $rules;
    }
    public function messages(): array
    {
        return [
            'required' => __('tag::validation.required'),
            'max' => __('tag::validation.max'),
            'integer' => __('tag::validation.integer'),
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('url::validation.attributes.title'),
            'description' => __('url::validation.attributes.description'),
            'urls' => __('url::validation.attributes.urls'),
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
