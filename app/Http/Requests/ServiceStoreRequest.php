<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'name_en' => 'required|string|max:255|unique:services,name_en',
            'name_ar' => 'required|string|max:255|unique:services,name_ar',
            'short_description_en' => 'nullable|string',
            'short_description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
        ];
    }

        public function messages()
    {
        return [
            'name_en.required' =>'الإسم باللغة الإنجليزية مطلوب',
            'name_en.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'name_en.max' =>'اقصي عدد احرف للاسم هو 255',
            'name_en.unique' =>'إسم الخدمة باللغة الإنجليزية بالفعل موجود',


            'name_ar.required' =>'الإسم باللغة العربية مطلوب',
            'name_ar.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'name_ar.max' =>'اقصي عدد احرف للاسم هو 255',
            'name_ar.unique' =>'إسم الخدمة باللغة العربية بالفعل موجود',

            'short_description_en.string' =>'الوصف القصير باللغة الانجليزية يجب ان يتكون من احرف',
            'short_description_ar.string' =>'الوصف القصير باللغة العربية يجب ان يتكون من احرف',

            'description_en.string' =>'الوصف باللغة الانجليزية يجب ان يتكون من احرف',
            'description_ar.string' =>'الوصف باللغة العربية يجب ان يتكون من احرف',

            'section_id.required' => 'القسم التابع له الخدمة مطلوب',
            'section_id.exists' => 'الفقسم الذي تم اختيارة غير موجود بقاعدة البيانات',

            'price.required' => '   سعر الخدمة مطلوب',
            'price.numeric' => 'سعر الخدمة يجب أن يكون رقم',

            'image.image' => 'الملف المرفوع يجب ان يكون صورة',
            'image.mimes' => 'صيغة الصورة يجب أن تكون واحدة من jpeg,jpg,png,svg,gif,jfif',

        ];
    }
}
