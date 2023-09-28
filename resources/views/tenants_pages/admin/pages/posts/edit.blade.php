@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل الخدمة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الخدمات </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            @php
                                $sections = App\Models\Section::all();
                            @endphp

                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.services.update',$service->id)}} enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="service_id" value="{{$service->id}}" />

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='name_ar'>إسم الخدمة باللغة العربية</label>
                                            <input type='text' name='name_ar' class= 'form-control  mt-1 mb-3' value="{{ old('name_ar' , $service->name_ar) }}" placeholder = "إسم الخدمة باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='name_en'>إسم الخدمة باللغة الإنجليزية</label>
                                            <input type='text' name='name_en' class= 'form-control  mt-1 mb-3' value="{{ old('name_en' , $service->name_en) }}" placeholder = "إسم الخدمة باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='short_description_ar'>وصف قصير للخدمة باللغة العربية</label>
                                            <input type='text' name='short_description_ar' class= 'form-control  mt-1 mb-3' value="{{ old('short_description_ar' , $service->short_description_ar) }}" placeholder = "وصف قصير للخدمة باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='short_description_en'>وصف قصير للخدمة باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en' class= 'form-control  mt-1 mb-3' value="{{ old('short_description_en' , $service->short_description_en) }}" placeholder = "وصف قصير للخدمة باللغة الإنجليزية">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف الخدمة باللغة العربية</label>
                                            <textarea name='description_ar' class= 'form-control  mt-1 mb-3' id="description_ar" value="{{ old('description_ar' , $service->description_ar) }}" placeholder = "وصف الخدمة باللغة العربية">{{ $service->description_ar }}</textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف الخدمة باللغة الإنجليزية</label>
                                            <textarea name='description_en' class= 'form-control  mt-1 mb-3' id="description_en" value="{{ old('description_en' , $service->description_en) }}" placeholder = "وصف الخدمة باللغة الإنجليزية">{{ $service->description_en }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='section_id'>القسم</label>
                                            <select name='section_id' value="section_id" class = 'form-control  mt-1 mb-3' placeholder = "الخدمة ">
                                                <option value="">أختر القسم </option>
                                                @foreach($sections as $section)
                                                    <option value="{{$section->id}}"{{ $section->id == $service->section_id ? 'selected' : '' }}>{{$section->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>سعر الخدمة</label>
                                            <input type='number' min="0" step="any" name='price' class= 'form-control  mt-1 mb-3' value="{{ old('price' , $service->price) }}" placeholder = "سعر الخدمة  ">
                                        </div>

                                    </div>

                                    <div class="row mb-5">
                                        <div>
                                            <label>
                                                تفعيل الخدمة
                                            </label>
                                        </div>
                                       <div class="checkbox">
                                            <input type="checkbox" name="active" {{ $service->active == 1 ? 'checked' : ''}} data-toggle="toggle" class="btn-outline-secondary" data-onstyle="success" data-offstyle="danger" data-on="مفعلة" data-off="غير مفعلة" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        <h6 class="card-title mb-1"> إستبدال الصورة</h6>
                                                        <p class="text-muted card-sub-title">رفع صورة تعبر عن التصنيف (إختياري)</p>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <input type="file" name="image" class="dropify" data-height="200" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                     <div class="row">
                                        <div class="col text-center my-3">
                                            <img src="{{url('uploads/services'.'/'. $service->image)}}" width="300px" alt="{{$service->name_en}}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button value="submit" class ='btn btn-secondary btn-flat'>تعدبل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#description_en',
    setup: function (editor) {
      editor.on('init', function () {
        editor.setContent('{!! old("description_en", $service->description_en) !!}');
      });
    }
  });
</script>
@endsection

