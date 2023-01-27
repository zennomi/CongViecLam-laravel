<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'name' => "required|unique:roles,name",
            ];
        } else {
            return [
                'name' => "required|unique:roles,name,{$this->role->id}",
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'The role name field is required!',
            'name.unique' => 'This role has already been taken!'
        ];
    }
}
