@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        {{-- <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto my-3">أعمالنا السابقة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة أعمالنا السابقة</span>
            </div>
        </div> --}}

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->

								<!-- row opened -->
				<div class="row row-sm">
					<!--div-->

                    @include('inc.messages')
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">أعمالنا السابقة</h4>
                                    <button class="btn btn-primary"><a class="x-small text-white" href="{{route("tenant.admin.works.create")}}">إضافة عمل</a></button>
								</div>

							</div>
							<div class="card-body">
								<div class="table-responsive">
                                        <table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
												<th>#</th>
												<th>العنوان</th>
                                                <th>تاريخ الإنجاز</th>

                                                @can('show-work')
                                                    <th>التفاصيل</th>
												@endcan
												@can('edit-work')
                                                    <th>تعديل</th>
												@endcan
												@can('delete-work')
                                                    <th>حذف</th>
												@endcan
											</tr>
										</thead>
										<tbody id="filtered-results">
                                            @if($works)
                                                @foreach ($works as $work )
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $work->title_ar}}</td>
                                                        <td>{{Carbon\Carbon::parse($work->finishing_date)->format('d M ,Y')}}</td>
                               
                                                        @can('show-work')
                                                            <td>
                                                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#show_work{{ $work->id }}" title="تفاصيل التصنيف"><i class="fa fa-eye"></i></button>
                                                                <!-- Show Modal -->
                                                                <form action="{{route('tenant.admin.works.show',$work)}}" method="POST" >
                                                                    <div class="modal fade" id="show_work{{$work->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel" class="text-primary">عرض تفاصيل العمل <span class="text-muted">{{$work->title_ar}}</span></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                    @csrf
                                                                                    @if($work->image)
                                                                                        <img src="{{ url('uploads/works').'/'. $work->image}}" class="w-100" alt ="{{ $work->title }}">
                                                                                    @endif
                                                                                    <h4 class="mb-2">الوصف القصير : <span class="text-muted">{{ $work->short_description_ar }}</span></h4>
                                                                                    <h4 class="mb-2">الوصف :{{ $work->description_ar }}</h4>
                                                                                    <hr>
                
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>


                                                        @endcan
                                                        @can('edit-work')
                                                            <td>
                                                                <a href="{{route('tenant.admin.works.edit',$work->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                            </td>
                                                         @endcan





                                                        @can('delete-work')
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_work{{ $work->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                                                <!-- Delete Modal -->
                                                                <form action="{{route('tenant.admin.works.destroy',$work)}}" method="POST">
                                                                    <div class="modal fade" id="delete_work{{$work->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">حذف عمل من قائمة أعمالنا السابقة</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p> هل انت متأكد من حذف العمل : {{$work->title}}</p>

                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        {{-- {{method_field('delete')}} --}}
                                                                                        <input type="hidden" value="{{$work->id}}" name="id">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                                            <button type="submit" title="submit" class="btn btn-danger">حذف</button>
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        @endcan
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>{{ trans('admin.not_found') }}</p>
                                            @endif

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
                    <div class="d-flex justify-content-center align-items-center my-5">
                        {{ $works-> links() }}
                    </div>

				<!-- /row -->






				<!-- /row -->



			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    
@endsection
