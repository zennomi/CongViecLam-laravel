<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateFormRequest extends FormRequest
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
        return [
            'username' => 'sometimes|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'organization_type_id' => 'required',
            'industry_type_id' => 'required',
            'team_size_id' => 'nullable',
            'nationality_id' => 'required',
            'establishment_date' => 'nullable',
            'website' => 'nullable|url|max:255',
        ];
    }
}
