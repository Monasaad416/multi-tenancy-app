@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0 my-3"> إضافة رأي </h4>
            </div>
            <div class="col-sm-6 my-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.testimonials.index')}}" class="default-color">قائمة أراء العملاء   </a></li>
                    <li class="breadcrumb-item active">إضافة رأي </li>
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
                            <form method="post" action={{ route('tenant.admin.testimonials.store')}} >
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for='client_name'>إسم العميل  </label><span class="text-danger">*</span>
                                        <input type='text' name='client_name' class= 'form-control mt-1 mb-3  @error('client_name') is-invalid @enderror' placeholder = "إسم العميل  ">
                                    </div>

                                    <div class="form-group">
                                        <label for='review'>رأي العميل</label>
                                        <textarea name='review' class= 'form-control mt-1 mb-3  @error('review') is-invalid @enderror' placeholder = "رأي العميل"></textarea>
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

