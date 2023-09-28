@extends('tenants_pages.admin.layout.master')

@section('css')
<!--Internal  Datetimepicker-slider css -->
<link href="{{url('dashboard/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{url('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{url('dashboard/assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
<!-- breadcrumb -->
    <div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0 my-3"> إضافة عمل </h4>
        </div>
        <div class="col-sm-6 my-3">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('tenant.admin.works.index')}}" class="default-color">قائمة الأعمال السابقة  </a></li>
                <li class="breadcrumb-item active">إضافة عمل </li>
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
                        <form method="post" action={{ route('tenant.admin.works.store')}} enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="form-group col-4">
                                        <label for='title_ar'>إسم العمل باللغة العربية</label><span class="text-danger">*</span>
                                        <input type='text' name='title_ar' class= 'form-control mt-1 mb-3  @error('title_ar') is-invalid @enderror' placeholder = "إسم العمل باللغة العربية">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for='title_en'>إسم العمل باللغة الإنجليزية</label>
                                        <input type='text' name='title_en' class= 'form-control mt-1 mb-3  @error('title_en') is-invalid @enderror' placeholder = "إسم العمل باللغة الإنجليزية">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for='finishing_date'>تاريخ  إنجاز العمل</label>
                                        <input class="form-control fc-datepicker @error('finishing_date') is-invalid @enderror" name="finishing_date"   placeholder="YYYY-MM-DD" type="text">
                                    </div>
                                </div>    

                                <div class="row mb-3">
                                    <div class="form-group col-6">
                                        <label for='short_description_ar'>وصف قصير للعمل باللغة العربية</label>
                                        <input type='text' name='short_description_ar' class= 'form-control mt-1 mb-3  @error('short_description_ar') is-invalid @enderror' placeholder = "وصف قصير للعمل باللغة العربية">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for='short_description_en'>وصف قصير للعمل باللغة الإنجليزية</label>
                                        <input type='text' name='short_description_en' class= 'form-control mt-1 mb-3  @error('short_description_en') is-invalid @enderror' placeholder = "وصف قصير للعمل باللغة الإنجليزية">
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col-6">
                                        <label for='description_ar'>وصف العمل باللغة العربية</label>
                                        <textarea name='description_ar' class= 'form-control mt-1 mb-3  @error('description_ar') is-invalid @enderror' placeholder = "وصف العمل  باللغة العربية"></textarea>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for='description_en'>وصف العمل باللغة الإنجليزية</label>
                                        <textarea name='description_en' class= 'form-control mt-1 mb-3  @error('description_en') is-invalid @enderror' placeholder = "وصف العمل  باللغة الإنجليزية"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <div class="form-group col-12">
                                        <label for='section_id'>القسم</label>
                                        <select name='section_id' value="section_id" class = 'form-control mt-1 mb-3  @error('section_id') is-invalid @enderror' placeholder = "القسم">
                                            <option value="">أختر القسم </option>
                                            @foreach(App\Models\Section::all() as $section)
                                                <option value="{{$section->id}}">{{$section->name_ar}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>     --}}



                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <h6 class="card-title mb-1"> الصورة</h6>
                                                    <p class="text-muted card-sub-title">رفع صورة تعبر عن العمل (إختياري)</p>
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
<!--Internal  Datepicker js -->
<script src="{{url('dashboard/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{url('dashboard/assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{url('dashboard/assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{url('dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{url('dashboard/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{url('dashboard/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{url('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{url('dashboard/assets/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{url('dashboard/assets/js/form-elements.js')}}"></script>
@endsection

