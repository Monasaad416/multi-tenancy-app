@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل القسم</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام </span>
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
                                $categories = App\Models\Category::all();
                            @endphp

                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.sections.update',$section->id)}} enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="service_id" value="{{$section->id}}" />

                                <div class="card-body">
                                    <input type="hidden" name="section_id" value="{{$section->id}}">
                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='name_ar'>إسم القسم باللغة العربية</label>
                                            <input type='text' name='name_ar' class= 'form-control mt-1 mb-3  @error('name_ar') is-invalid @enderror' value="{{ old('name_ar' , $section->name_ar) }}" placeholder = "إسم القسم باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='name_en'>إسم القسم باللغة الإنجليزية</label>
                                            <input type='text' name='name_en' class= 'form-control mt-1 mb-3  @error('name_en') is-invalid @enderror' value="{{ old('name_en' , $section->name_en) }}" placeholder = "إسم القسم باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='short_description_ar'>وصف قصير للخدمة باللغة العربية</label>
                                            <input type='text' name='short_description_ar' class= 'form-control  mt-1 mb-3' value="{{ old('short_description_ar' , $section->short_description_ar) }}" placeholder = "وصف قصير للخدمة باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='short_description_en'>وصف قصير للخدمة باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en' class= 'form-control  mt-1 mb-3' value="{{ old('short_description_en' , $section->short_description_en) }}" placeholder = "وصف قصير للخدمة باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف القسم باللغة العربية</label>
                                            <textarea name='description_ar' rows="5" class= 'form-control  mt-1 mb-3' id="description_ar" value="{{ old('description_ar' , $section->description_ar) }}" placeholder = "وصف القسم باللغة العربية">{{ $section->description_ar }}</textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف القسم باللغة الإنجليزية</label>
                                            <textarea name='description_en' rows="5" class= 'form-control  mt-1 mb-3' id="description_en" value="{{ old('description_en' , $section->description_en) }}" placeholder = "وصف القسم باللغة الإنجليزية">{{ $section->description_en }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='category_id'>التصنيف</label>
                                            <select name='category_id' value="category_id" class = 'form-control  mt-1 mb-3' placeholder = "القسم ">
                                                <option value="">أختر التصنيف </option>
                                                @foreach(App\Models\Category::all() as $cat)
                                                    <option value="{{$cat->id}}"{{ $cat->id == $section->category_id ? 'selected' : '' }}>{{$section->category_id}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div calss="col-6">
                                            <div>
                                                <label>
                                                    تفعيل القسم
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <input type="checkbox" name="active" {{ $section->active == 1 ? 'checked' : ''}} data-toggle="toggle" class="btn-outline-secondary" data-onstyle="success" data-offstyle="danger" data-on="مفعل" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        @if(!$section->image)
                                                            
                                                        @else
                                                            <h6 class="card-title mb-1">إستبدال الصورة</h6>
                                                        @endif
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

                                    @if($section->image)
                                        <div class="row">
                                            <div class="col text-center my-3">
                                                <img src="{{url('uploads/sections'.'/'. $section->image)}}" width="300px" alt="{{$section->name_en}}">
                                            </div>
                                        </div>
                                    @endif    


                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button value="submit" class ='btn btn-secondary btn-flat'>تعديل</button>
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


@endsection

