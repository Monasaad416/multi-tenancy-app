<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;


class BundleUpdateRequest extends FormRequest
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
        $bundleId = Route::current()->parameter('bundle'); 
        return [
            'name' => ['nullable','string','max:255',Rule::unique('bundles', 'name')->ignore($bundleId)],
            'payment_type' => 'nullable|string',
            'payment_system' => 'nullable|numeric',
        ];
    }

        
    public function messages()
    {
        return [
            'name.string' =>'إسم الباقة يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم الباقة هو 255',
            'name.unique' =>'إسم الباقة بالفعل موجود',

            'price.numeric' =>'سعر الباقة يجب أن يكون رقم ',

            'payment_system.required' =>'نظام دفع الباقة  مطلوب',
            'payment_system.numeric' =>'نظام دفع الباقة يجب أن يكون رقم ',
        ];
    }
}
