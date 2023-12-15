<?php

namespace Modules\Group\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route()->group;
        return [
            'name' => 'required|string|max:100|unique:groups,name'.(!empty($id) ?','.$id : false)
        ];
    }
    public function messages(): array
    {
        return [
            'required' => __('group::validation.required'),
            'unique' => __('group::validation.unique'),
            'max' => __('group::validation.max'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('group::validation.attributes.name'),
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
