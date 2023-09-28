<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class WorkUpdateRequest extends FormRequest
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
        $workId = Route::current()->parameter('work'); 
        return [
            'title_en' => ['nullable','string','max:255',Rule::unique('sections', 'title_en')->ignore($workId)],
            'title_ar' => ['nullable','string','max:255',Rule::unique('sections', 'title_ar')->ignore($workId)],
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
            'finishing_date' => 'date',
        ];
    }

        public function messages()
    {
        return [
            'title_en.required' =>'العنوان باللغة الإنجليزية مطلوب',
            'title_en.string' =>'العنوان باللغة الانجليزية يجب ان يتكون من احرف',
            'title_en.max' =>'اقصي عدد احرف للاسم هو 255',

            'title_ar.required' =>'العنوان باللغة العربية مطلوب',
            'title_ar.string' =>'العنوان باللغة العربية يجب ان يتكون من احرف',
            'title_ar.max' =>'اقصي عدد احرف للاسم هو 255',

            'short_description_en.string' =>'الوصف القصير باللغة الانجليزية يجب ان يتكون من احرف',
            'short_description_ar.string' =>'الوصف القصير باللغة العربية يجب ان يتكون من احرف',

            'description_en.string' =>'الوصف باللغة الانجليزية يجب ان يتكون من احرف',
            'description_ar.string' =>'الوصف باللغة العربية يجب ان يتكون من احرف',

            'section_id.required' => 'القسم التابع له الخدمة مطلوب',
            'section_id.exists' => 'الفقسم الذي تم اختيارة غير موجود بقاعدة البيانات',

            'image.image' => 'الملف المرفوع يجب ان يكون صورة',
            'image.mimes' => 'صيغة الصورة يجب أن تكون واحدة من jpeg,jpg,png,svg,gif,jfif',
            
            'finishing_date.date' => 'يرجي كتابة صيغة لصحيحة لتاريخ إنجاز العمل',

        ];
    }
}
