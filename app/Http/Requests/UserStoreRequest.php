<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email| unique:users',
            'phone' => 'nullable|string',
            'roles_name' => 'required',
            'password' => 'required|min:8|confirmed',

        ];

    }

        public function messages()
    {
        return [
            'name.required' =>'اسم الموظف مطلوب',
            'name.string' =>'إسم الموظف  يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم الموظف هو 255',

            'email.required' =>'البريد الإلكتروني  مطلوب',
            'email.email' =>'يرجي كتابة صيغة بريد إلكتروني صحيحة',
            'email.unique' =>'البريد الإلكتروني المكتوب بالفعل مسجل ',
            'roles_name.required' => 'مهام الموظف مطلوبة',

            'phone.string' =>'رقم الهاتف يجب أن يتكون من أرقام وعلامات',

            'address.string' =>'العنوان يجب ان يتكون من احرف',

            'password.required' => 'كلمة السر  مطلوبة',
            'password.min' => 'كلمة السر يجب إن تتكون من 8 أحرف علي الأقل',
            'passwordconfirmed' => 'كلمة السر وتاكيد كلمة السر يجب أن يكونا متطابقان',
        ];
    }
}
