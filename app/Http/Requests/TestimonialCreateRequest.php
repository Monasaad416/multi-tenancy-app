<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialCreateRequest extends FormRequest
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
            'review' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
        ];
    }

        public function messages()
    {
        return [
            'review.required' =>'الإسم باللغة الإنجليزية مطلوب',
            'review.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'review.max' =>'اقصي عدد احرف للاسم هو 255',

            'client_name.required' =>'الإسم باللغة العربية مطلوب',
            'client_name.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'client_name.max' =>'اقصي عدد احرف للاسم هو 255',

        ];
    }
}