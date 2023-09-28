<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

        public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'short_description_ar' => 'nullable|string',
            'short_description_en' => 'nullable|string',
            'body_ar' => 'nullable|string',
            'body_en' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svf,gif,jfif',
            'video_title' => 'nullable|string|max:255',
            'video_path' => 'nullable|file|mimetypes:video/mp4,ogx,oga,ogv,ogg,web'
        ];
    }

        public function messages()
    {
        return [
            'name_en.required' =>'الإسم باللغة الإنجليزية مطلوب',
            'name_en.string' =>'الإسم باللغة الانجليزية يجب ان يتكون من احرف',
            'name_en.max' =>'اقصي عدد احرف للإسم باللغة العربية هو 255',

            'name_ar.required' =>'الإسم باللغة العربية مطلوب',
            'name_ar.string' =>'الإسم باللغة العربية يجب ان يتكون من احرف',
            'name_ar.max' =>'اقصي عدد احرف للإسم باللغة العربية هو 255',

            'short_description_ar.max' =>'اقصي عدد احرف للوصف القصير باللغة العربية هو 255',
            'short_description_ar.string' =>'الوصف القصير باللغة العربية يجب ان يتكون من احرف',

            'short_description_en.max' =>'اقصي عدد احرف للوصف القصير باللغة الإنجليزية هو 255',
            'short_description_en.string' =>'الوصف القصير باللغة الإنجليزية يجب ان يتكون من احرف',

            'category_id.exists' => 'التصنيف الذي تم اختيارة غير موجود بقاعدة البيانات',

            'video_title.string' => 'عنوان الفديو يجب ان يتكون من احرف',
            'video_title.max' =>'اقصي عدد احرف لعنوان الفديو هو 255',

            'video_path.mimes' =>' mp4,ogx,oga,ogv,ogg,web إمتداد الفديو يجب ان يكون واحد من',
            'image.mimes' =>' jpg,jpeg,png,svg,gif إمتداد الصورة يجب ان يكون واحد من',
        ];
    }
}
