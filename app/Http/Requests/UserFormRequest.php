<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
                'name' => "required",
                'email' => "required|unique:admins,email",
                'password' => "required|min:8",
                'roles' => "required",
            ];
        } else {
            return [
                'name' => "required",
                'email' => "required|unique:admins,email,{$this->user->id}",
                'roles' => "required",
            ];
        }
    }
}
