<?php

namespace App\Http\Requests;

use App\Rules\CheckAdminCurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $id = auth()->id();

        if (request()->isPasswordChange) {
            return [
                'name' => "required",
                'email' => "required|unique:users,email,$id",
                'current_password' => ['required', new CheckAdminCurrentPassword()],
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'image'     =>  ['nullable', 'image', 'max:1024']
            ];
        } else {
            return [
                'name' => "required",
                'email' => "required|unique:users,email,$id",
                'image'     =>  ['nullable', 'image', 'max:1024']
            ];
        }
    }
}
