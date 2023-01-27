<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobFormRequest extends FormRequest
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
        $min = $this->input('min_salary');
        $max = $this->input('max_salary');

        if ($this->method() == 'PUT') {
            return [
                'title' => 'required|string|max:255',
                'company_id' => 'required|numeric',
                'category_id'  => 'required|numeric',
                'role_id'  => 'required|numeric',
                'experience' => 'required',
                'education'  => 'required',
                'vacancies'  => 'required|string',
                'job_type'  => 'required',
                'min_salary'  => 'required|numeric|between:0,' . $max,
                'max_salary' => 'required|numeric|min:' . $min,
                'salary_type' => 'required',
                'deadline' => 'required',
                'description' => 'required',
                'apply_on' => 'nullable',
                'apply_email' => 'nullable|email',
                'apply_url' => 'nullable|url',
                'featured' => 'nullable|numeric',
                'highlight' => 'nullable|numeric',
                'isremote' => 'nullable|numeric'
            ];
        } elseif ($this->method() == 'POST') {
            return [
                'title' => 'required|string|max:255',
                'company_id' => 'required|numeric',
                'category_id'  => 'required|numeric',
                'role_id'  => 'required|numeric',
                'experience' => 'required',
                'education'  => 'required|numeric',
                'vacancies'  => 'required|string',
                'job_type'  => 'nullable',
                'min_salary'  => 'required|numeric|between:0,' . $max,
                'max_salary' => 'required|numeric|min:' . $min,
                'salary_type' => 'nullable',
                'deadline' => 'required',
                'description' => 'required',
                'apply_on' => 'nullable',
                'apply_email' => 'nullable|email',
                'apply_url' => 'nullable|url',
                'featured' => 'nullable|numeric',
                'highlight' => 'nullable|numeric',
                'isremote' => 'nullable|numeric'
            ];
        }
    }
}
