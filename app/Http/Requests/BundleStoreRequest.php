<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BundleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:bundles,name',
            'price' => 'required|numeric',
            'payment_system' => 'required|numeric',
        ];
    }

        public function messages()
    {
        return [
            'name.required' =>' إسم الباقة مطلوب',
            'name.string' =>'إسم الباقة يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم الباقة هو 255',
            'name.unique' =>'إسم الباقة بالفعل موجود',

            'price.required' =>'سعر الباقة  مطلوب',
            'price.numeric' =>'سعر الباقة يجب أن يكون رقم ',

            'payment_system.required' =>'نظام دفع الباقة  مطلوب',
            'payment_system.numeric' =>'نظام دفع الباقة يجب أن يكون رقم ',
        ];
    }
}
