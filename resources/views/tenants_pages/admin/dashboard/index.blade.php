@extends('tenants_pages.admin.layout.master')

@section('css')
<!--  Owl-carousel css-->
<link href="{{url('dashboard/assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{url('dashboard/assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')

@endsection
@section('content')
			<!-- row -->
			<div class="row row-sm">
				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-primary-gradient">
						<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
							<div class="">
								<h6 class="mb-3 tx-12 text-white"> عدد التصنيفات</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Category::count()}}{!! "&nbsp;" !!}تصنيف</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white"> عدد الأقسام</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Section::count()}}{!! "&nbsp;" !!}قسم</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-success-gradient">
						<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
							<div class="">
								<h6 class="mb-3 tx-12 text-white"> عدد الخدمات</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Service::count()}}{!! "&nbsp;" !!}خدمة</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-warning-gradient">
						<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
							<div class="">
								<h6 class="mb-3 tx-12 text-white"> عدد الأعمال السابقة</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Work::count()}}{!! "&nbsp;" !!}عمل</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-primary-gradient">
						<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
							<div class="">
								<h6 class="mb-3 tx-12 text-white"> عدد الرسائل</h6>
							</div>
							<div class="pb-0 mt-0">
								<div class="d-flex">
									<div class="">
										<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Message::count()}}{!! "&nbsp;" !!}رسالة</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-6 col-md-6 col-xm-12">
					<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white"> عدد العملاء</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{App\Models\Section::count()}}عميل</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
			<!-- row closed -->

			<!-- row opened -->
			<div class="row row-sm">
				<div class="col-md-12 col-lg-12 col-xl-6">
					<div class="card">
						<div class="card-header bg-transparent ">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-0">متابعة الخدمات</h4>
								<i class="fas fa-ellipsis-v"></i>
							</div>
						</div>
						<div class="col-lg-12 col-xl-12">
							<div class="card card-dashboard-map-one d-flex justify-contenr-center align-items-center">
								<div >
									{!! $chartjs->render() !!}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-xl-6">
					<div class="card">
						<div class="card-header bg-transparent ">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-0">متابعة الأعمال التي تم إنجازها لسنة {{Carbon\Carbon::now()->format('Y')}}</h4>
								<i class="fas fa-ellipsis-v"></i>
							</div>
						</div>
						<div class="col-lg-12 col-xl-12">
							<div class="card card-dashboard-map-one d-flex justify-contenr-center align-items-center">
								<div >
									{!! $chartjs2->render() !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- row closed -->

			<!-- row opened -->
			<div class="row row-sm">
				<div class="col-xl-6 col-md-12 col-lg-12">
					<div class="card">
						<div class="card-header pb-1">
							<h3 class="card-title mb-2">العملاء الجدد</h3>
						</div>
						<div class="card-body p-0 customers mt-1">
							<div class="list-group list-lg-group list-group-flush">
							    @foreach(App\Models\Client::latest()->get()->take(5) as $client)
									<div class="list-group-item list-group-item-action" href="#">
										<div class="media mt-0">
											<div class="media-body">
												<div class="d-flex align-items-center">
													<div class="mt-0">
														<h5 class="mb-1 tx-15">{{$client->name}}</h5>
														<p class="mb-0 tx-13 text-muted">الهاتف {!! "&nbsp;" !!}:{!! "&nbsp;" !!}<span class="text-success ml-2">{{$client->phone}}</span></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-md-12 col-lg-6">
					<div class="card">
						<div class="card-header pb-1">
							<h3 class="card-title mb-2">أحدث الخدمات</h3>
						</div>
						<div class="product-timeline card-body pt-2 mt-1">
							@php
								$services = App\Models\Service::latest()->get()->take(5);
							@endphp
							<ul class="timeline-1 mb-0">
								@if(count($services) >= 1 )
									<li class="mt-0"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $services[0]->name_ar}}</span> <a href="#" class="float-left tx-11 text-muted"> {{Carbon\Carbon::parse($services[0]->created_at)->diffForHumans()}}</a>
									</li>
								@endcan
								@if(count($services) >= 2 )
									<li class="mt-0"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $services[1]->name_ar}}</span> <a href="#" class="float-left tx-11 text-muted">{{Carbon\Carbon::parse($services[1]->created_at)->diffForHumans()}}</a>
									</li>
								@endif
								@if(count($services) >= 3 )
									<li class="mt-0"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $services[2]->name_ar}}</span> <a href="#" class="float-left tx-11 text-muted"> {{Carbon\Carbon::parse($services[2]->created_at)->diffForHumans()}}</a>
									</li>
								@endcan
								@if(count($services) >= 4 )
									<li class="mt-0"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $services[3]->name_ar}}/span> <a href="#" class="float-left tx-11 text-muted"> {{Carbon\Carbon::parse($services[3]->created_at)->diffForHumans()}}</a>
									</li>
								@endcan
								@if(count($services) >= 5 )
									<li class="mt-0"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="font-weight-semibold mb-4 tx-14 ">{{ $services[4]->name_ar}}</span> <a href="#" class="float-left tx-11 text-muted"> {{Carbon\Carbon::parse($services[4]->created_at)->diffForHumans()}}</a>
									</li>
								@endcan
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- row close -->

		</div>
	</div>
	<!-- Container closed -->
	@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{url('dashboard/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{url('dashboard/assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{url('dashboard/assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{url('dashboard/assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{url('dashboard/assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{url('dashboard/assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{url('dashboard/assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{url('dashboard/assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{url('dashboard/assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{url('dashboard/assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('dashboard/assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{url('dashboard/assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{url('dashboard/assets/js/index.js')}}"></script>
<script src="{{url('dashboard/assets/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
