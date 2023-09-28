@extends('admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row my-4">
            <div class="col-sm-6">
                <h4 class="mb-0"> تعديل الباقة </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.bundles.index')}}" class="default-color">قائمة الباقات</a></li>
                    <li class="breadcrumb-item active">تعديل الباقة </li>
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
                            <form method="post" action={{ route('admin.bundles.update',$bundle->id)}}>
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="bundle_id" value="{{$bundle->id}}">
                                        <div class="form-group col-6">
                                            <label for='name'>إسم الباقة  </label><span class="text-danger">*</span>
                                            <input type='text' name='name'  value="{{ old('name',$bundle->name) }}"  class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم الباقة  ">
                                        </div>

                                        <div class="checkbox col-6 mt-4">
                                            <label>
                                                 تفعيل الباقة <input type="checkbox" name="active" {{$bundle->active == 1 ? 'checked' : ''}} data-toggle="toggle" class="btn-outline-secondary mx-4" data-onstyle="success" data-offstyle="danger" data-on="مفعل" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                            </label>
                                        </div>

                                    </div>


                                    <div class="row">    
                                        <div class="form-group col-6">
                                            <label for='payment_system'>نظام الدفع</label><span class="text-danger">*</span>
                                            <select name='payment_system' value="payment_system" class = 'form-control mt-1 mb-3 @error('payment_system') is-invalid @enderror'>
                                                <option value="">أختر نظام الدفع </option>
                                                <option value="1" {{$bundle->payment_system == 1 ? 'selected' : ''}}> شهري</option>
                                                <option value="2" {{$bundle->payment_system == 2 ? 'selected' : ''}}> ربع سنوي</option>
                                                <option value="3" {{$bundle->payment_system == 3 ? 'selected' : ''}}> نصف سنوي</option>
                                                <option value="4" {{$bundle->payment_system == 4 ? 'selected' : ''}}> سنوي</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for='price'>سعر الباقة</label>
                                            <input type="number" step="any" name='price' value="{{ old('price' ,$bundle->price) }}" class= 'form-control mt-1 mb-3 @error('price') is-invalid @enderror' placeholder = "سعر الباقة"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">    
                                        <div class="form-group col">
           
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button value="submit" class ='btn btn-secondary btn-flat' >تعديل</button>
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

