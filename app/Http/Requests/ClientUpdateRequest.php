<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(Request $request): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => [Rule::unique('clients')->ignore($request->user()->id)],
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',

        ];

    }

        public function messages()
    {
        return [
            'name.string' =>'إسم العميل  يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم العميل هو 255',

            'email.email' =>'يرجي كتابة صيغة بريد إلكتروني صحيحة',
            'email.unique' =>'البريد الإلكتروني المكتوب بالفعل مسجل ',

            'phone.string' =>'رقم الهاتف يجب أن يتكون من أرقام وعلامات',

            'address.string' =>'العنوان يجب ان يتكون من احرف',

            'password.nullable' => 'السر يجب مطلوبة',
            'password.min' => 'كلمة السر يجب إن تتكون من 8 أحرف علي الأقل',
            'passwordconfirmed' => 'كلمة السر وتاكيد كلمة السر يجب أن يكونا متطابقان',
        ];
    }
}
