<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules['name'] = 'required';
        $rules['code'] = 'nullable|unique:products,code,' . $this->product;
        $rules['price'] = '';
        $rules['description'] = '';
        return $rules;
    }
}
