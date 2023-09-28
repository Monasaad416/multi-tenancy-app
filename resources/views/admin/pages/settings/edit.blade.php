
@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تحديث إعدادات الموقع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
   <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <div class="card">
        @include('inc.errors')
        @include('inc.messages')
        <form method="post" action="{{route('admin.settings.update')}}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">

                    <div class="row">
                        <div class="col-md-6">
                            <label for='title_ar'>الإسم باللغة العربية</label>
                            <input type="text" class='form-control  @error('title_ar') is-invalid @enderror' name='title_ar' value="{{ $settings->title_ar}}" >
                        </div>
                        <div class="col-md-6">
                            <label for='title_en'>الإسم باللغة الإنجليزية</label>
                            <input type="text" class='form-control  @error('title_en') is-invalid @enderror' name='title_ar' value={{ $settings->title_en}} >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for='title_ar'>العنوان باللغة العربية</label>
                            <input type="text" class='form-control  @error('address_ar') is-invalid @enderror' name='title_ar' value={{ $settings->title_ar}} >
                        </div>
                        <div class="col-md-6">
                            <label for='title_ar'>العنوان باللغة الإنجليزية</label>
                            <input type="text" class='form-control  @error('address_en') is-invalid @enderror' name='title_ar' value={{ $settings->title_ar}} >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for='phone'>الهاتف</label>
                            <input type="text" class='form-control  @error('phone') is-invalid @enderror' name='phone' value={{ $settings->phone}} >
                        </div>
                        <div class="col-md-6">
                            <label for='email'>البريد الإلكتروني</label>
                            <input type="email" class='form-control  @error('email') is-invalid @enderror' name='email' value={{ $settings->email}} >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for='facebook'>رابط الفيس بوك</label>
                            <input type="text" class='form-control  @error('facebook') is-invalid @enderror' name='facebook' value={{ $settings->facebook}} >

                        </div>
                        <div class="col-md-6">
                            <label for='instagram'>رابط الإنستاجرام</label>
                            <input type="text" class='form-control  @error('instagram') is-invalid @enderror' name='instagram' value={{ $settings->instagram}} >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for='linkedin'>رابط لبنكد إن</label>
                            <input type="text" class='form-control  @error('linkedin') is-invalid @enderror' name='linkedin' value={{ $settings->linkedin}} >
                        </div>
                        <div class="col-md-6">
                            <label for='twitter'>رابط تويتر</label>
                            <input type="text" class='form-control  @error('twitter') is-invalid @enderror' name='twitter' value={{ $settings->twitter}} >
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h6 class="card-title mb-1"> إستبدال الأيقونة</h6>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <input type="file" name="favicon" class="dropify" data-height="200" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($settings->favicon)
                        <div class="row">
                            <div class="col my-3">
                            <div class="text-center">
                                <img src="{{url('uploads/settings'.'/'. $settings->favicon)}}" width="300px" alt="favicon">
                            </div>
                            </div>
                        </div>
                    @endif


                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h6 class="card-title mb-4"> إستبدال الشعار</h6>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <input type="file" name="logo" class="dropify" data-height="200" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($settings->logo)
                        <div class="row">
                            <div class="col text-center my-3">
                                <img src="{{url('uploads/settings'.'/'. $settings->logo)}}" width="200px" alt="logo">
                            </div>
                        </div>
                    @endif


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-secondary">تحديث</button>
                    </div>



                </div>
            </div>
        <form>
    </div>
@endsection
@section('js')
@endsection

