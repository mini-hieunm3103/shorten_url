<?php

namespace Modules\User\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route()->user;
        // check xem có phải là update dữ liệu hay là thêm
        // nếu update thì phải tránh báo lỗi khi trùng với chính nó:  `unique:users,email,'.$user->id`
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1',
            'group_id' => ['required','integer', function($attribute, $value, $fail){
                if ($value == 0){
                    $fail(__('user::validation.select'));
                }
            }]
        ];
        if (!empty($id)){
            $rules['email'] = 'required|email|unique:users,email,'.$id;
            if (!empty($this->password)){
                $rules['password'] = 'min:1';
            } else{
                unset($rules['password']);
            }
        }
        return $rules;
    }
    public function messages(): array
    {
        return [
            'required' => __('user::validation.required'),
            'email' => __('user::validation.email'),
            'unique' => __('user::validation.unique'),
            'min' => __('user::validation.min'),
            'integer' => __('user::validation.integer')
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('user::validation.attributes.name'),
            'email' => __('user::validation.attributes.email'),
            'password' => __('user::validation.attributes.password'),
            'group_id' => __('user::validation.attributes.group_id'),
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
