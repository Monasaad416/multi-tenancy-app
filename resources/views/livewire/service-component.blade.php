<div class="card-body">
<div class="table-responsive">
    <input type="text" class="form-control my-4 search" wire:model="serviceName" placeholder="إبحث بإسم الخدمة">
    <table class="table table-hover mb-0 text-md-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>الأسم</th>
            <th>الوصف</th>
            <th>سعر الخدمة </th>
            @can('show-service')
                <th>التفاصيل</th>
            @endcan
            @can('edit-service')
                <th>تعديل</th>
            @endcan
            @can('delete-service')
                <th>حذف</th>
            @endcan

            @can('toggle-service')
                <th>حالة التفعيل</th>
            @endcan    
        </tr>
    </thead>
    <tbody id="filtered-results">
        @if($services)
            @foreach ($services as $service )
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $service->name_ar}}</td>
                    <td>{{ $service->description_ar ?  $service->description_ar :'---' }}</td>

                    <td>{{ $service->price}} جنيه</td>
                    @can('show-service')
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#show_service{{ $service->id }}" title="تفاصيل التصنيف"><i class="fa fa-eye"></i></button>
                            <!-- Show Modal -->
                            <form action="{{route('tenant.admin.categories.show',$service)}}" method="POST" >
                                <div class="modal fade" id="show_service{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" class="text-primary">عرض تفاصيل الخدمة <span class="text-muted">{{$service->name_ar}}</span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <p></p>

                                                @csrf
                                                {{-- {{method_field('delete')}} --}}
                                                <input type="hidden" value="{{$service->id}}" name="id">
                                                @if($service->image)
                                                    <img src="{{ url('uploads/categories').'/'. $service->image}}" class="w-100" alt ="{{ $service->name }}">
                                                @endif
                                                <h4 class="mb-2">الوصف القصير : <spna class="text-muted">{{ $service->short_description_ar }}</spna></h4>
                                                <h4 class="mb-2">الوصف :{{ $service->description_ar }}</h4>
                                                <hr>
                                                <strong class="mb-2">السعر :   <span class="text-danger">{{ $service->price }}</span>جنيه </strong>
                                                <p class="mt-2">الخدمة التابع له :{{ $service->section->name_ar }}</p>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </td>


                    @endcan
                    @can('edit-service')
                        <td>
                            <a href="{{route('tenant.admin.services.edit',$service->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                        </td>
                    @endcan

                    @can('delete-service')
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_service{{ $service->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                            <!-- Delete Modal -->
                            <form action="{{route('tenant.admin.services.destroy',$service)}}" method="POST">
                                <div class="modal fade" id="delete_service{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">حذف خدمة من قائمة الخدمات</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <p> هل انت متأكد من حذف الخدمة : {{$service->name}}</p>

                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- {{method_field('delete')}} --}}
                                                    <input type="hidden" value="{{$service->id}}" name="id">
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

                    @can('toggle-service')
                        <td>
                            <a data-toggle="modal" data-target="#change-state-{{$service->id}}" class="btn btn-sm btn-{{$service->active == 1 ? 'success' : 'danger'}} mx-1" title="{{$service->active == 1 ? 'مفعلة' : 'غير مفعلة'}}">
                                <i class="fa fa-toggle-{{$service->active == 1 ? 'on' : 'off'}}" style="color: #fff";></i>
                            </a>
                        </td>
                        <!-- Change state modal  -->
                        <form action="{{route('tenant.admin.service.toggle_state',$service->id)}}" method="post">
                            <div class="modal fade" id="change-state-{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تعديل حالة التفعيل للخدمة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>هل انت متأكد من تعديل حالة التفعيل للخدمة  :{{$service->name_ar}}؟</p>
                                            @csrf
                                            <input type="hidden" value="{{$service->id}}" name="id">
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
            <p>{{ trans('admin.not_found') }}</p>
        @endif

    </tbody>
</table>
</div>
<div class="d-flex justify-content-center align-items-center my-5">
{{ $services-> links() }}
</div>
</div>



