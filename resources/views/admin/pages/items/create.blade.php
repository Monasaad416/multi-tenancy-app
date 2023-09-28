@extends('admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row ">
            <div class="col-sm-6">
                <h4 class="my-3">إضافة بند للباقات</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb my-3 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.items.index')}}" class="default-color">قائمة البنود</a></li>
                    <li class="breadcrumb-item active">إضافة بند</li>
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
                            <br>
                            @include('inc.errors')
                            @livewire('create-item-component')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')


@endsection


