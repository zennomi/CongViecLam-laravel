<?php

namespace Modules\Currency\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyUpdateFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required|unique:currencies,name,{$this->currency->id}",
            'code' => "required|regex:/^[a-zA-Z]+$/u|unique:currencies,code,{$this->currency->id}",
            'symbol' => "required|string|max:2|unique:currencies,symbol,{$this->currency->id}",
        ];
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
