@extends('tenants_pages.admin.layout.master')

@section('css')
    @livewireStyles
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة العملاء</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                {{-- <h4 class="card-title mg-b-0">العملاء</h4> --}}
                <button class="btn btn-primary">
                    <a class="x-small text-white" href="{{route("tenant.admin.clients.create")}}">
                        <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة عميل 
                    </a>
                </button>
            </div>

        </div>
		<!-- row opened -->
        <div class="row row-sm">
            <!--div-->

            @include('inc.messages')
            <div class="col-xl-12">
                @livewire('client-component')
            </div>
            <!--/div-->
        

        <!-- /row -->
        </div>
    </div>
@endsection
@section('js')

@endsection
