<?php

namespace Modules\Testimonial\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'name' => "required|unique:testimonials,name",
                'image' => "max:3072|image",
                'description' => "required",
                'position' => "required",
                'stars' => "required",
            ];
        } else {
            return [
                'name' => "required|unique:testimonials,name,{$this->testimonial->id}",
                'image' => "max:3072|image",
                'description' => "required",
                'position' => "required",
                'stars' => "required",
            ];
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
