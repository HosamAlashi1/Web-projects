<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'mobile' => 'required|max:100|unique:vendors,mobile,'.$this ->id, // this for update
            'email' => 'required|email|unique:vendors,email,'.$this ->id, // this for update
            'password' => 'required_without|string|min:6',
            'category_id' => 'required|exists:main_categories,id',
        ];
        // $this->id  >> Refers to when you update the vendor will return (error message) for update email and phone 
        // ,if you dont change the value for email and phone because the email and mobile (unique) value
    }

    public function messages(){
        return [
            'logo.required_without' => 'يرجى ادخال صورة',
            'password.required_without' => 'يرجى ادخال كلمة المرور',
            'required' => 'هذا الحقل مطلوب ',
            'mimes' => 'jpg,jpeg,png  امتداد الملف يجب ان يكون احدى الأتية ',
            'string' => ' هذا الحقل لا يقبل غير الاحرف والارقام',
            'max' => ' يجب ان يكون طول النص اقل من 100 حرف ',
            'email.email' => 'البريد الالكتروني غير صالح ',
            'email.unique' => 'البريد الالكتروني موجود مسبقا ',
            'mobile.unique' => 'رقم الهاتف موجود مسبقا ',
            'password.min' => 'يجب ان تكون طول كلمة المرور اكثر من 6 حرف ',
            'category_id.exists' => 'القسم غير موجود ',
        ];
    }
}