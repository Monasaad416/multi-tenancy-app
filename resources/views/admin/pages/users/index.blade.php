@extends('admin.layout.master')

@section('css')
    @livewireStyles
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الموظفين</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                {{-- <h4 class="card-title mg-b-0">الموظفين</h4> --}}
                <button class="btn btn-primary">
                    <a class="x-small text-white" href="{{route("admin.users.create")}}">
                        <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة موظف 
                    </a>
                </button>
            </div>

        </div>
		<!-- row opened -->
        <div class="row row-sm">
            <!--div-->

            @include('inc.messages')
            <div class="col-xl-12">
                @livewire('user-component')
            </div>
            <!--/div-->
        

        <!-- /row -->
        </div>
    </div>
@endsection
@section('js')

@endsection
