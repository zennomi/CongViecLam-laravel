<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
        $userid = Company::findOrFail($this->company);
        if ($this->method() == 'PUT') {
            return [
                'name' => 'required',
                'email' => 'email|unique:users,email,' . $userid->user_id,
                'password' => 'nullable|max:35|min:8',
                'image'     =>  ['nullable', 'image', 'max:1024'],
                'logo'     =>  ['nullable', 'image', 'max:1024'],
                'banner'     =>  ['nullable', 'image', 'max:1024'],
                'organization_type' => 'string|max:255',
                'establishment_date' => 'nullable',
                'website' => 'nullable|url|max:255',
                'visibility' => 'required|max:1',
                'team_size' => 'nullable|string|max:255',
                'bio' => 'nullable',
                'industry_type_id' => 'required',
                'nationality' => 'required',
                'vision' => 'nullable',
            ];
        } elseif ($this->method() == 'POST') {
            return [
                'name' => 'string|max:255|required',
                'email' => 'required|email|unique:users,email',
                'organization_type' => 'required|string|max:255',
                'establishment_date' => 'nullable|max:255',
                'industry_type_id' => 'required',
            ];
        }
    }
}
