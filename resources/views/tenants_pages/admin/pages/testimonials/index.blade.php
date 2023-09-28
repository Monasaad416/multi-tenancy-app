@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">أراء العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة أراء العملاء</span>

            </div>
        </div>

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
                  <button class="btn btn-primary"><a class="x-small text-white" href="{{route("tenant.admin.testimonials.create")}}">إضافة رأي</a></button>

            </div>
            <div class="card-body">
                <div class="table-responsive">   

                        <table class="table table-hover mb-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>العميل</th>
                                <th>التقييم</th>
                                @can('edit-testimonial')
                                    <th>تعديل</th>
                                @endcan
                                @can('delete-testimonial')
                                    <th>حذف</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody id="filtered-results">
                            @if($testimonials)
                                @foreach ($testimonials as $testimonial )
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $testimonial->client_name}}</td>
                                        <td>{{ $testimonial->review}}</td>



                                        @can('edit-testimonial')
                                            <td>
                                                <a href="{{route('tenant.admin.testimonials.edit',$testimonial->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                            </td>
                                        @endcan

                                        @can('delete-testimonial')
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_testimonial{{ $testimonial->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                                <!-- Delete Modal -->
                                                <form action="{{route('tenant.admin.testimonials.destroy',$testimonial)}}" method="post">
                                                    <div class="modal fade" id="delete_testimonial{{$testimonial->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">حذف رأي من قائمة أراء العملاء</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> هل انت متأكد من حذف رأي العميل : {{$testimonial->name}}</p>

                                                                    @csrf
                                                                    @method('DELETE')
                                                    
                                                                    <input type="hidden" value="{{$testimonial->id}}" name="id">
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
        {{ $testimonials-> links() }}
    </div>

<!-- /row -->
</div>



				<!-- /row -->



			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection
