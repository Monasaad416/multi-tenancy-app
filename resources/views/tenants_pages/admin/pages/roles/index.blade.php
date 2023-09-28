@extends('tenants_pages.admin.layout.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
    <div class="page-title">
        <div class="row my-2">
            <div class="col-sm-6 my-2">
                <h4 class="mb-0 ">قائمة المهام</h4>
            </div>
            <div class="col-sm-6 my-2">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.dashboard.index')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active">قائمة المهام</li>
                </ol>
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
                                        <a class="x-small text-white" href="{{route("tenant.admin.roles.create")}}">
                                            <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة مهمة
                                        </a>
                                    </button>
								</div>
								{{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-hover mb-0 text-md-nowrap">
										<thead>
											<tr>
                                                <th>#</th>
                                                <th>الإسم</th>
                                                <th width="280px">تعديل</th>
                                                <th width="280px">حذف</th>
											</tr>
										</thead>
										<tbody>

                                            @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>

                                                <td>
                                                    <a href="{{route('tenant.admin.roles.edit',$role->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل الباقة"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#role{{ $role->id }}" title="حذف الباقة"><i class="fa fa-trash"></i></button></td>
                                                    <!-- Delete Modal -->
                                                    <form action="{{route('tenant.admin.roles.destroy',$role)}}" method="POST">
                                                        <div class="modal fade" id="role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">حذف المهمة من قائمة المهام</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل انت متأكد من حذف  {{$role->name_ar}}</p>

                                                                        @csrf
                                                                        {{method_field('delete')}}
                                                                        <input type="hidden" value="{{$role->id}}" name="id">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                            <button type="submit" name="submit" class="btn btn-danger">حذف</button>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<div class="d-flex justify-content-center align-items-center">
					{{ $roles->links() }}
				</div>

				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection




