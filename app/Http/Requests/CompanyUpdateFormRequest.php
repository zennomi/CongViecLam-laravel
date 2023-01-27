<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateFormRequest extends FormRequest
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
            'name' => 'required',
            'username' => "required|unique:users,username,{$this->company->user->id}",
            'email' => "required|email|unique:users,email,{$this->company->user->id}",
            'organization_type_id' => 'required',
            'industry_type_id' => 'required',
            'team_size_id' => 'nullable',
            'nationality_id' => 'required',
            'website' => 'nullable|url|max:255',
        ];
    }
}
