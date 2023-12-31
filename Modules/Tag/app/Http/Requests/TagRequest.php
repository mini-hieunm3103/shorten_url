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
        $id = $this->route()->tag;
        $rules = [
            'title' => 'unique:tags,title'.(!empty($id) ? ','.$id : false).'|required|max:255|regex:#^[a-zA-Z0-9\s]+$#',
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
            'regex' => __('tag::validation.regex'),
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('url::validation.attributes.title'),
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
