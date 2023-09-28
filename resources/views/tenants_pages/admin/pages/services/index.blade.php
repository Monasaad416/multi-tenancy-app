@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto my-3">الخدمات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الخدمات</span>
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
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary">
                            <a class="x-small text-white" href="{{route("tenant.admin.services.create")}}">
                                <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة خدمة 
                            </a>
                        </button>
                    </div>

                </div>

				@livewire('service-component')


				<!-- /row -->



			</div>
			<!-- Container closed -->
		</div>

    </div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
