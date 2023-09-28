@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row my-4">
            <div class="col-sm-6">
                <h4 class="mb-0"> إضافة تصنيف</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.categories.index')}}" class="default-color">قائمة التصنيفات</a></li>
                    <li class="breadcrumb-item active">إضافة تصنيف</li>
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


                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.categories.store')}} enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for='name_ar'>إسم التصنيف باللغة العربية</label><span class="text-danger">*</span>
                                            <input type='text' name='name_ar'  value="{{ old('name_ar') }}"  class= 'form-control mt-1 mb-3 @error('name_ar') is-invalid @enderror' placeholder = "إسم التصنيف باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='name_en'>إسم التصنيف باللغة الإنجليزية</label><span class="text-danger">*</span>
                                            <input type='text' name='name_en' value="{{ old('name_en') }}" class= 'form-control mt-1 mb-3 @error('name_en') is-invalid @enderror' placeholder = "إسم التصنيف باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف قصير للتصنيف باللغة العربية</label>
                                            <input type='text' name='short_description_ar' value="{{ old('short_description_en') }}" class= 'form-control mt-1 mb-3 @error('short_description_ar') is-invalid @enderror' placeholder = "وصف قصير للتصنيف باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف قصير للتصنيف باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en'value="{{ old('short_description_en') }}" class= 'form-control mt-1 mb-3 @error('short_description_en') is-invalid @enderror' placeholder = "وصف قصير للتصنيف باللغة الإنجليزية">
                                        </div>
                                    </div>

                                    <div class="row">    
                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف التصنيف باللغة العربية</label>
                                            <textarea rows="5" name='description_ar'value="{{ old('description_ar') }}" class= 'form-control mt-1 mb-3 @error('description_ar') is-invalid @enderror' placeholder = "وصف التصنيف باللغة العربية"></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف التصنيف باللغة الإنجليزية</label>
                                            <textarea rows="5" name='description_en' value="{{ old('description_en') }}" class= 'form-control mt-1 mb-3 @error('description_en') is-invalid @enderror' placeholder = "وصف التصنيف باللغة الإنجليزية"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <div class="form-group col">
                                            <label for='parent_id'> التصنيف الرئيسي </label><span class="text-danger">*</span>
                                            <select name='parent_id' value="parent_id" class = 'form-control mt-1 mb-3 @error('parent_id') is-invalid @enderror' placeholder = "التصنيف الرئيسي">
                                                <option value="">أختر التصنيف الرئيسي</option>
                                                @foreach(App\Models\Category::all() as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name_ar}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="checkbox col">
                                            <label>
                                                 تفعيل التصنيف <input type="checkbox" name="active" checked data-toggle="toggle" class="btn-outline-secondary mx-4" data-onstyle="success" data-offstyle="danger" data-on="مفعل" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div>
                                                        <h6 class="card-title mb-1"> الصورة</h6>
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

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button value="submit" class ='btn btn-primary btn-flat' >حفظ</button>
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

