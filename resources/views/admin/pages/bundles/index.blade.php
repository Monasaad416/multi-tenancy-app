@extends('admin.layout.master')

@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الباقات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمة الباقات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        @include('inc.messages')
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        {{-- <h4 class="card-title mg-b-0">الباقات</h4> --}}
                        <button class="btn btn-primary">
                            <a class="x-small text-white" href="{{route("admin.bundles.create")}}">
                                <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة باقة 
                            </a>
                        </button>
                    </div>
                </div>

				<div class="card-body">
                    <div class="table-responsive">
                            {{-- <input type="text" class="form-control my-4 search" wire:model="catName" placeholder="إبحث بإسم الباقة"> --}}
                        <table class="table table-hover mb-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الأسم</th>
                                    <th>السعر</th>
                                    <th>نظام الدفع</th>
                         
                                    @can('edit-bundle')
                                        <th>تعديل</th>
                                    @endcan
                                    @can('delete-bundle')
                                        <th>حذف</th>
                                    @endcan
                                    @can('toggle-bundle')
                                        <th>التفعيل</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody id="filtered-results">
                                @if($bundles)
                                    @foreach ($bundles as $bundle )
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $bundle->name}}</td>
                                            <td>{{ $bundle->price}}</td>
                                            <td>{{ $bundle->payment_system}}</td>
                                            {{-- <td>{{ $bundle->specialist->name_ar }}</td> --}}

                                            @can('edit-bundle') 
                                                <td>
                                                    <a href="{{route('admin.bundles.edit',$bundle->id)}}" class="btn btn-info btn-sm" >
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            @endcan
                                            @can('delete-bundle') 
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-bundle{{ $bundle->id }}" title="حذف البند"><i class="fa fa-trash"></i></button>
                                                    <!-- Delete Modal -->
                                                    <form action="{{route('admin.bundles.destroy',$bundle)}}" method="POST">
                                                        <div class="modal fade" id="delete-bundle{{$bundle->id}}" tabindex="-1" bundle="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" bundle="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">حذف البند من قائمة البنود</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل انت متأكد من حذف البند :  {{$bundle->name}}</p>

                                                                        @csrf
                                                                        {{method_field('delete')}}
                                                                        <input type="hidden" value="{{$bundle->id}}" name="id">
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

                                            @can('toggle-bundle')
                                                <td>
                                                    <a data-toggle="modal" data-target="#change-state-{{$bundle->id}}" class="btn btn-sm btn-{{$bundle->active == 1 ? 'success' : 'danger'}} mx-1" title="{{$bundle->active == 1 ? 'مفعلة' : 'غير مفعلة'}}">
                                                        <i class="fa fa-toggle-{{$bundle->active == 1 ? 'on' : 'off'}}" style="color: #fff";></i>
                                                    </a>
                                                </td>
                                                <!-- Change state modal  -->
                                                <form action="{{route('admin.toggle_state',$bundle->id)}}" method="POST">
                                                    <div class="modal fade" id="change-state-{{$bundle->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تعديل حالة التفعيل للباقة</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>هل انت متأكد من تعديل حالة التفعيل للباقة  :{{$bundle->name}}?</p>
                                                                    @csrf
                                                                    <input type="hidden" value="{{$bundle->id}}" name="id">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                        <button type="submit" name="submit" class="btn btn-info">تعديل</button>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endcan

                                        </tr>
                                    @endforeach
                                @else
                                    <p clas="text-muted">لايوجد بيانات للعرض</p>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

			    </div>
            </div>
		</div>
	</div>
@endsection
@section('js')

@endsection
