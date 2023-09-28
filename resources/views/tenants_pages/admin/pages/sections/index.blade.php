@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto my-3">الأقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الأقسام</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

<!--div-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    {{-- <h4 class="card-title mg-b-0">الأقسام</h4> --}}
                    <button class="btn btn-primary">
                        <a class="x-small text-white" href="{{route("tenant.admin.sections.create")}}">
                            <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة قسم
                        </a>
                    </button>
                </div>

            </div>
        <!--div-->
        @include('inc.messages')
        <!-- row opened -->
        @livewire('section-component')

        </div>
    </div>
    <!--/div-->


@endsection
@section('js')

@endsection
