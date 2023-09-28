<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ITemStoreRequest extends FormRequest
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
        ];
    }

        public function messages()
    {
        return [
            'name.required' =>'إسم البند مطلوب مطلوب',
            'name.string' =>'إسم البند يجب ان يتكون من احرف',
            'name.max' =>'اقصي عدد احرف لإسم البند هو 255'
        ];
    }

}    

