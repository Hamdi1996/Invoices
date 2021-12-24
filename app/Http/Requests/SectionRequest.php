<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
            'section_name'=>'required|max:15|unique:sections,section_name,'.$this->id,
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'section_name.required'=>'يرجي ادخال اسم القسم',
            'section_name.unique'=>'هذا القسم موجود بالفعل' ,
            'description.required'=>'يرجي ادخال الوصف'
        ];

    }
   
}
