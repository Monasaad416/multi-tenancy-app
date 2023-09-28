@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرسائل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الرسائل</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
	<!-- row opened -->
<div class="row row-sm">
    <!--div-->

    @include('inc.messages')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                {{-- <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">الرسائل</h4>
                </div> --}}

            </div>

			@livewire('message-component')
           
        </div>
    </div>
    <!--/div-->
<!-- /row -->
</div>

@endsection
@section('js')

@endsection
