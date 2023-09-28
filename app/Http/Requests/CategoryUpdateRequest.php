<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $catId = Route::current()->parameter('category'); 
        return [
            'name_en' => ['nullable','string','max:255',Rule::unique('categories', 'name_en')->ignore($catId)],
            'name_ar' => ['nullable','string','max:255',Rule::unique('categories', 'name_ar')->ignore($catId)],
            'short_description_en' => 'nullable|string|max:255',
            'short_description_ar' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
        ];
    }

        public function messages()
    {
        return [
            'name_en.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'name_en.max' =>'اقصي عدد احرف للاسم هو 255',

            'name_ar.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'name_ar.max' =>'اقصي عدد احرف للاسم هو 255',

            'short_description_en.string' =>'الوصف القصير باللغة الانجليزية يجب ان يتكون من احرف',
            'short_description_ar.string' =>'الوصف القصير باللغة العربية يجب ان يتكون من احرف',

            'short_description_en.max' =>'اقصي عدد احرف للاسم هو 255',
            'short_description_ar.max' =>'اقصي عدد احرف للاسم هو 255',

            'description_en.string' =>'الوصف باللغة الانجليزية يجب ان يتكون من احرف',
            'description_ar.string' =>'الوصف باللغة العربية يجب ان يتكون من احرف',
            
            'parent_id.exists' => 'التصنيف الذي تم اختيارة غير موجود بقاعدة البيانات',
        ];
    }
}
