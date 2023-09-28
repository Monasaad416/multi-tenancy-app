@extends('admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row my-4">
            <div class="col-sm-6">
                <h4 class="mb-0"> تعديل نظام المشترك </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.tenants.index')}}" class="default-color">قائمة المشتركين</a></li>
                    <li class="breadcrumb-item active">تعديل نظام المشترك </li>
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
                            <form method="post" action={{ route('admin.tenants.update',$tenant->id)}}>
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="tenant_id" value="{{$tenant->id}}">
                                        <div class="form-group col-6">
                                            <label for='name'>إسم المشترك  </label><span class="text-danger">*</span>
                                            <input type='text' name='subdomain'  value="{{ old('subdomain',$tenant->id) }}"  class= 'form-control mt-1 mb-3 @error('subdomain') is-invalid @enderror'>
                                        </div>

                                        <div class="checkbox col-6 mt-4">
                                            <label>
                                                تفعيل المشترك <input type="checkbox" name="active" {{$tenant->active == 1 ? 'checked' : ''}} data-toggle="toggle" class="btn-outline-secondary mx-4" data-onstyle="success" data-offstyle="danger" data-on="مفعل" data-off="غير مفعل" data-onstyle="success" data-offstyle="danger">
                                            </label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">الباقة: <span class="tx-danger">*</span></label>
                                            <select class="form-control" name="bundle_id">
                                                <option value="">إختر الباقة</option>
                                                @foreach(App\Models\Bundle::all() as $bundle)
                                                    <option value="{{ $bundle->id }}" {{ $tenant->bundle_id == $bundle->id ? 'selected' : '' }}>{{ $bundle->name }}</option>
                                                @endforeach
                                            </select>
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

