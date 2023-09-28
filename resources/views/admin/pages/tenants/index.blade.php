@extends('admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة المشتركين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المشتركين</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->

				<div class="row row-sm">
					<!--div-->

                    {{-- @include('inc.messages') --}}
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									{{-- <h4 class="card-title mg-b-0">قائمة المشتركين</h4> --}}
                                    <button class="btn btn-primary">
                                        <a class="x-small text-white" href="{{route("admin.tenants.create")}}">
                                            <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة مشترك
                                        </a></button>
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
				
                            @livewire('tenant-component')
                            
						</div>
					</div>
					<!--/div-->



          
				</div>


				<!-- /row -->



			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
