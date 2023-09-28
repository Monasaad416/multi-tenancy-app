@extends('admin.layout.master')

@section('css')

@endsection

@section('page-header')
	<!-- breadcrumb -->
    <div class="page-title">
        <div class="row my-2">
            <div class="col-sm-6 my-2">
                <h4 class="mb-0 ">قائمة البنود</h4>
            </div>
            <div class="col-sm-6 my-2">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}" class="default-color">الرئيسية</a></li>
                    <li class="breadcrumb-item active"> البنود</li>
                </ol>
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
                        <button class="btn btn-primary">
                            <a class="x-small text-white" href="{{route("admin.items.create")}}">
                                <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة بند 
                            </a>
                        </button>
                    </div>
                    {{-- <p class="tx-12 tx-gray-500 mb-2">Example of Valex Hoverable Rows Table.. <a href="">Learn more</a></p> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if($items->count() > 0)
                            <table class="table table-hover mb-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>وصف البند</th>
                                        @can('edit-item') 
                                            <th width="280px">تعديل</th> 
                                        @endcan

                                        @can('delete-item') 
                                            <th width="280px">حذف</th> 
                                        @endcan
                    

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $item->name }}</td>
                                            @can('edit-item') 
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-item{{ $item->id }}" title="تعديل البند"><i class="fa fa-edit"></i></button>
                                                    <!-- Edit Modal -->
                                                    <form action="{{route('admin.items.update',$item)}}" method="POST">
                                                        <div class="modal fade" id="edit-item{{$item->id}}" tabindex="-1" item="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" item="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">تعديل البند : {{$item->name}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                        @csrf
                                                                        {{method_field('PATCH')}}
                                                                        <input type="hidden" value="{{$item->id}}" name="item_id">
                                                                        <input type="text" class="form-control" value="{{$item->name}}" name="name">
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                            <button type="submit" name="submit" class="btn btn-info">تعديل</button>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            @endcan
                                            @can('delete-item') 
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-item{{ $item->id }}" title="حذف البند"><i class="fa fa-trash"></i></button>
                                                    <!-- Delete Modal -->
                                                    <form action="{{route('admin.items.destroy',$item)}}" method="POST">
                                                        <div class="modal fade" id="delete-item{{$item->id}}" tabindex="-1" item="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" item="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">حذف البند من قائمة البنود</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>هل انت متأكد من حذف البند :  {{$item->name}}</p>

                                                                        @csrf
                                                                        {{method_field('delete')}}
                                                                        <input type="hidden" value="{{$item->id}}" name="id">
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
                                </tbody>
                            </table>

                            @else
                                <h4 class="text-danger">لاتوجد بيانات للعرض</h4>    
                            @endif
                    </div>
                </div>
            </div>
        </div>
      
        </div>
        <div class="d-flex justify-content-center align-items-center">
            {{ $items->links() }}
        </div>
		</div>

	</div>
@endsection




