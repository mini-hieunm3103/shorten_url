<?php

namespace Modules\Url\app\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UrlRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route()->url;
        $userId = $this->input('user_id');
        $rules = [
            'back_half' => 'unique:urls,back_half'.(!empty($id) ? ','.$id : false).'|nullable|regex:#^[a-zA-Z0-9]+$#|',
            'user_id' => ['required','integer', function($attribute, $value, $fail){
                if ($value == 0){
                    $fail(__('url::validation.select'));
                }
            }],
            'archived' => 'required|integer',
            // Được phép trùng title với 2 user_id khác nhau nhưng khi 1 user_id đặt title giống nhau sẽ báo lỗi
            'title' => 'unique:urls,title,'.(!empty($id) ? $id : 'NULL').',id,user_id,'.$userId.'|nullable|string|max:255',
            'long_url' => 'unique:urls,long_url,'.(!empty($id) ? $id : 'NULL').',id,user_id,'.$userId.'|url|max:255'
        ];
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
