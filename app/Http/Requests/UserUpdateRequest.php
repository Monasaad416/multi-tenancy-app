<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(Request $request): array
    {
        $userId = Route::current()->parameter('user'); 
        return [
            'name' => 'nullable|string|max:255',
            'email' => ['nullable','string','max:255',Rule::unique('users', 'name')->ignore($userId)],
            'phone' => 'nullable|string',
            'roles_name' => 'nullable',

        ];

    }

        public function messages()
    {
        return [
            'name.string' =>'إسم الموظف  يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم الموظف هو 255',

            'email.email' =>'يرجي كتابة صيغة بريد إلكتروني صحيحة',
            'email.unique' =>'البريد الإلكتروني المكتوب بالفعل مسجل ',

            'phone.string' =>'رقم الهاتف يجب أن يتكون من أرقام وعلامات',

            'address.string' =>'العنوان يجب ان يتكون من احرف',

        ];
    }
}
