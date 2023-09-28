@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0 my-3"> إضافة خدمة</h4>
            </div>
            <div class="col-sm-6 my-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.services.index')}}" class="default-color">قائمة الخدمات</a></li>
                    <li class="breadcrumb-item active">إضافة خدمة</li>
                </ol>
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
                            <br>

                            @php
                                $sections = App\Models\Section::all();
                            @endphp
                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.services.store')}} enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row mb-3"><span class="text-danger">*</span>
                                        <div class="form-group col-6">
                                            <label for='name_ar'>إسم الخدمة باللغة العربية</label> <span class="text-danger">*</span>
                                            <input type='text' name='name_ar' class= 'form-control mt-1 mb-3 @error('name_ar') is-invalid @enderror' placeholder = "إسم الخدمة باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='name_en'>إسم الخدمة باللغة الإنجليزية</label> <span class="text-danger">*</span>
                                            <input type='text' name='name_en' class= 'form-control mt-1 mb-3 @error('name_en') is-invalid @enderror' placeholder = "إسم الخدمة باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='short_description_ar'>وصف قصير للخدمة باللغة العربية</label>
                                            <input type='text' name='short_description_ar' class= 'form-control mt-1 mb-3 @error('short_description_ar') is-invalid @enderror' placeholder = "وصف قصير للخدمة باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='short_description_en'>وصف قصير للخدمة باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en' class= 'form-control mt-1 mb-3 @error('short_description_en') is-invalid @enderror' placeholder = "وصف قصير للخدمة باللغة الإنجليزية">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف الخدمة باللغة العربية</label>
                                            <textarea name='description_ar' class= 'form-control mt-1 mb-3 @error('description_ar') is-invalid @enderror' placeholder = "وصف الخدمة باللغة العربية"></textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف الخدمة باللغة الإنجليزية</label>
                                            <textarea name='description_en' class= 'form-control mt-1 mb-3 @error('description_en') is-invalid @enderror' placeholder = "وصف الخدمة باللغة الإنجليزية"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='category_id'>التصنيف</label> <span class="text-danger">*</span>
                                            <select name='category_id' value="category_id" class = 'form-control mt-1 mb-3 @error('section_id') is-invalid @enderror' placeholder = "الخدمة ">
                                                <option value="">أختر التصنيف </option>
                                                @foreach(App\Models\Category::all() as $category)
                                                    <option value="{{$category->id}}">{{$category->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for='section_id'>القسم</label> <span class="text-danger">*</span>
                                            <select name='section_id' value="section_id" class = 'form-control mt-1 mb-3 @error('section_id') is-invalid @enderror' placeholder = "الخدمة ">
                            
                                            </select>
                                        </div>

                     

                                    </div>



                                    <div class="row mb-5">

                                        <div class="form-group col-6">
                                            <label for='description_en'>سعر الخدمة</label> <span class="text-danger">*</span>
                                            <input type='number' min="0" step="any" name='price' class= 'form-control mt-1 mb-3 @error('description_en') is-invalid @enderror' placeholder = "سعر الخدمة ">
                                        </div>
                                        <div class="checkbox col">
                                            <label>
                                                 تفعيل الخدمة <input type="checkbox" name="active" checked data-toggle="toggle" class="btn-outline-secondary mx-4" data-onstyle="success" data-offstyle="danger" data-on="مفعلة" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        <h6 class="card-title mb-1"> الصورة</h6>
                                                        <p class="text-muted card-sub-title">رفع صورة تعبر عن الخدمة (إختياري)</p>
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

                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button value="submit" class ='btn btn-primary btn-flat' >حفظ</button>
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

    
@push('scripts')
    <script>
        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ URL::to('/admin/sections') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();

                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection

