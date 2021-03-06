<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'=>'required|max:55',
            'description'=>'required|max:150',
            // 'section_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'product_name.required'=>'يرجي ادخال اسم المنتج',
            'description.required'=>'يرجي ادخال الوصف'
        ];
    }

}
