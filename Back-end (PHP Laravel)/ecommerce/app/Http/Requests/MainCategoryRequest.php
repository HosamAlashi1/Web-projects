<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo' => 'required_without:id|mimes:jpg,jpeg,png', 
            'category' => 'required|array|min:1',
            'category.*.name' => 'required',
            'category.*.translation_lang' => 'required',
        ];
    }

    public function messages(){
        return [
            'required_without' => 'يرجى ادخال صورة',
            'required' => 'هذا الحقل مطلوب ',
            'mimes' => 'jpg,jpeg,png  امتداد الملف يجب ان يكون احدى الأتية ',
            'category.min' => ' يجب ان تملأ قسم عللى الاقل',
        ];
    }
}
