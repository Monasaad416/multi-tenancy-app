<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',
            'address_en' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'favivon' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
        ];
    }

        public function messages()
    {
        return [
            'title_en.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'title_en.max' =>'اقصي عدد احرف للاسم هو 255',

            'title_ar.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'title_ar.max' =>'اقصي عدد احرف للاسم هو 255',

            'address_en.string' =>'الوصف القصير باللغة الانجليزية يجب ان يتكون من احرف',
            'address_ar.string' =>'الوصف القصير باللغة العربية يجب ان يتكون من احرف',

            'facebook.url' =>'يرجي كتابة صيغة رابط صحيح لحساب الفيس بوك',
            'twitter.url' =>'يرجي كتابة صيغة رابط صحيح  لحساب تويتر',
            'linkedin.url' =>'يرجي كتابة صيغة رابط صحيح  لحساب لينكيد إن',
            'instagram.url' =>'يرجي كتابة صيغة رابط صحيح  لحساب إنستاجرام',

            'phone.string' => 'يرجي كتابة رقم هاتف صحيح',
            'email.email' =>'يرجي كتابة صيغة بريد إلكتروني صحيحة',

            'image.image' => 'الملف المرفوع يجب ان يكون صورة',
            'image.mimes' => 'صيغة الصورة يجب أن تكون واحدة من jpeg,jpg,png,svg,gif,jfif',
        ];
    }
}
