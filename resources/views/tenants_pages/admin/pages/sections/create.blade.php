@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0 my-3"> إضافة قسم</h4>
            </div>
            <div class="col-sm-6 my-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.sections.index')}}" class="default-color">قائمة الاقسام</a></li>
                    <li class="breadcrumb-item active">إضافة قسم</li>
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
                                $categories = App\Models\Category::all();
                            @endphp

                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.sections.store')}} enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='name_ar'>إسم القسم باللغة العربية</label><span class="text-danger">*</span>
                                            <input type='text' name='name_ar' class= 'form-control mt-1 mb-3 @error('name_ar') is-invalid @enderror' placeholder = "إسم القسم باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='name_en'>إسم القسم باللغة الإنجليزية</label><span class="text-danger">*</span>
                                            <input type='text' name='name_en' class= 'form-control mt-1 mb-3 @error('name_en') is-invalid @enderror' placeholder = "إسم القسم باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='short_description_ar'>وصف قصير للقسم باللغة العربية</label>
                                            <input type='text' name='short_description_ar' class= 'form-control mt-1 mb-3 @error('short_description_ar') is-invalid @enderror' placeholder = "وصف قصير للقسم باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='short_description_en'>وصف قصير للقسم باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en' class= 'form-control mt-1 mb-3 @error('short_description_en') is-invalid @enderror' placeholder = "وصف قصير للقسم باللغة الإنجليزية">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف القسم باللغة العربية</label>
                                            <textarea rows="5" name='description_ar' class= 'form-control mt-1 mb-3 @error('parent_id') is-invalid @enderror' placeholder = "وصف القسم باللغة العربية"></textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف القسم باللغة الإنجليزية</label>
                                            <textarea rows="5" name='description_en' class= 'form-control mt-1 mb-3 @error('description_en') is-invalid @enderror' placeholder = "وصف القسم باللغة الإنجليزية"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col">
                                            <label for='category_id'>التصنيف</label><span class="text-danger">*</span>
                                            <select name='category_id' value="category_id" class = 'form-control mt-1 mb-3 @error('category_id') is-invalid @enderror' placeholder = "القسم ">
                                                <option value="">أختر التصنيف </option>
                                                @foreach($categories as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div>
                                            <label class="mx-3">
                                                تفعيل القسم
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="active" checked data-toggle="toggle" class="btn-outline-secondary" data-onstyle="success" data-offstyle="danger" data-on="مفعل" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        <h6 class="card-title mb-1"> الصورة</h6>
                                                        <p class="text-muted card-sub-title">رفع صورة تعبر عن القسم (إختياري)</p>
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
@endsection

