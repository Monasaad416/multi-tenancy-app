<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'review' => 'nullable|string|max:255',
            'client_name' => 'nullable|string|max:255',
        ];
    }

        public function messages()
    {
        return [
            'review.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'review.max' =>'اقصي عدد احرف للاسم هو 255',

            'client_name.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'client_name.max' =>'اقصي عدد احرف للاسم هو 255',

        ];
    }
}
