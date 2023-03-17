<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name unique'),
            'name.max' => 'اسم العرض طويل جدا',
            'price.required' => 'سعر العرض مطلوب',
        ];
    }
}
