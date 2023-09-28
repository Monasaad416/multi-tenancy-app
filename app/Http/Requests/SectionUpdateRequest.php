<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class SectionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
      public function rules(): array
    {
        $sectionId = Route::current()->parameter('section'); 
        return [
            'name_en' => ['nullable','string','max:255',Rule::unique('sections', 'name_en')->ignore($sectionId)],
            'name_ar' => ['nullable','string','max:255',Rule::unique('sections', 'name_ar')->ignore($sectionId)],
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
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

            'description_en.string' =>'الوصف باللغة الانجليزية يجب ان يتكون من احرف',
            'description_ar.string' =>'الوصف باللغة العربية يجب ان يتكون من احرف',

            'category_id.nullable' => 'التصنيف التابع له القسم مطلوب',
            'category_id.exists' => 'التصنيف الذي تم اختيارة غير موجود بقاعدة البيانات',

            'image.image' => 'الملف المرفوع يجب ان يكون صورة',
            'image.mimes' => 'صيغة الصورة يجب أن تكون واحدة من jpeg,jpg,png,svg,gif,jfif',
        ];
    }
}
