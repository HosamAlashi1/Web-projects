<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'abbr' => 'required|string|max:10',
            'direction' => 'required|in:rtl,ltr',            
        ];
    }

    public function messages(){
        return [
            'required' => 'هذا الحقل مطلوب ',
            'string' => 'هذا الحقل لا يقبل غير الاحرف',
            'in' => 'القيم المدخلة غير صحيحة',
            'name.max' => ' يجب ان يكول طول النص اقل من 100 حرف ',
            'abbr.max' => ' يجب ان يكول طول النص اقل من 10 احرف ',
        ];
    }
}
