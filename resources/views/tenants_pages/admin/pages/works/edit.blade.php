@extends('tenants_pages.admin.layout.master')

@section('css')
<!--Internal  Datetimepicker-slider css -->
<link href="{{url('dashboard/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{url('dashboard/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{url('dashboard/assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل العمل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأعمال السابقة </span>
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
                            @include('inc.errors')
                            <form method="post" action={{ route('tenant.admin.works.update',$work->id)}} enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group col-4">
                                            <label for='title_ar'>إسم العمل باللغة العربية</label><span class="text-danger">*</span>
                                            <input type='text' name='title_ar' value="{{ old('title_ar' , $work->title_ar) }}" class= 'form-control mt-1 mb-3  @error('title_ar') is-invalid @enderror' placeholder = "إسم العمل باللغة العربية">
                                        </div>

                                        <div class="form-group col-4">
                                            <label for='title_en'>إسم العمل باللغة الإنجليزية</label>
                                            <input type='text' name='title_en' value="{{ old('title_en' , $work->title_en) }}" class= 'form-control mt-1 mb-3  @error('title_en') is-invalid @enderror' placeholder = "إسم العمل باللغة الإنجليزية">
                                        </div>

                                        <div class="form-group col-4">
                                            <label for='finishing_date'>تاريخ  إنجاز العمل</label>
                                            <input class="form-control fc-datepicker @error('finishing_date') is-invalid @enderror" name="finishing_date" value="{{Carbon\Carbon::parse($work->finishing_date)->format('d M ,Y')}}"  placeholder="YYYY-MM-DD" type="text">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='short_description_ar'>وصف قصير للعمل باللغة العربية</label>
                                            <input type='text' name='short_description_ar' value="{{ old('short_description_ar' , $work->short_description_ar) }}" class= 'form-control mt-1 mb-3  @error('short_description_ar') is-invalid @enderror' placeholder = "وصف قصير للعمل باللغة العربية">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='short_description_en'>وصف قصير للعمل باللغة الإنجليزية</label>
                                            <input type='text' name='short_description_en' value="{{ old('short_description_en' , $work->short_description_en) }}" class= 'form-control mt-1 mb-3  @error('short_description_en') is-invalid @enderror' placeholder = "وصف قصير للعمل باللغة الإنجليزية">
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-6">
                                            <label for='description_ar'>وصف العمل باللغة العربية</label>
                                            <textarea name='description_ar' value="{{ old('description_ar' , $work->description_ar) }}" class= 'form-control mt-1 mb-3  @error('description_ar') is-invalid @enderror' placeholder = "وصف العمل  باللغة العربية"></textarea>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='description_en'>وصف العمل باللغة الإنجليزية</label>
                                            <textarea name='description_en' value="{{ old('name_en' , $work->name_en) }}" class= 'form-control mt-1 mb-3  @error('description_en') is-invalid @enderror' placeholder = "وصف العمل  باللغة الإنجليزية"></textarea>
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
                                                    @if(!$work->image)
                                                        
                                                    @else
                                                        <h6 class="card-title mb-1">إستبدال الصورة</h6>
                                                    @endif
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

                                    @if($work->image)
                                        <div class="row">
                                            <div class="col text-center my-3">
                                                <img src="{{url('uploads/works'.'/'. $work->image)}}" width="300px" alt="{{$work->title_en}}">
                                            </div>
                                        </div>
                                    @endif    
                                    <input type="hidden" name="work_id" value="{{$work->id}}" >

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

<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#description_en',
    setup: function (editor) {
      editor.on('init', function () {
        editor.setContent('{!! old("description_en", $work->description_en) !!}');
      });
    }
  });
</script>


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

