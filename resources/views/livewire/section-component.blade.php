
<div class="card-body">
    <div class="table-responsive">
        <!-- Search for sections -->
        <div class="row">
            <div class="col-6">
                <label for="">بحث بالتصنيف</label>
                <select wire:model="category_id" class="form-control" id="category_id" value="{{ old('category_id') }}" >
                    <option value="">-- إختر التصنيف--</option>
                    @foreach(App\Models\Category::all() as $catgory)
                        <option value ="{{$catgory->id}}">{{$catgory->name_ar}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <input type="text" class="form-control my-4 search_term" wire:model="section_name" placeholder="إبحث بإسم القسم">
            </div>

        </div>
        <table class="table table-hover mb-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الأسم</th>
                    <th>الصف القصير</th>
                    <th> التصنيف</th>
                    @can('show-section')
                        <th>التفاصيل</th>
                    @endcan
                    @can('edit-section')
                        <th>تعديل</th>
                    @endcan
                    @can('delete-section')
                        <th>حذف</th>
                    @endcan
                    @can('toggle_section')
                        <th>حالة التفعيل</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="filtered-results">
                @if($sections)
                    @foreach ($sections as $section )
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $section->name_ar}}</td>
                            <td>{{ $section->short_description_ar ?  $section->short_description_ar :'---' }}</td>

                            <td>{{ $section->category->name_ar}}</td>
                            @can('show-section')
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#show_section{{ $section->id }}" title="تفاصيل التصنيف"><i class="fa fa-eye"></i></button>
                                    <!-- Show Modal -->
                                    <form action="{{route('tenant.admin.sections.show',$section)}}" method="post" >
                                        <div class="modal fade" id="show_section{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="text-danger">عرض تفاصيل القسم {!! "&nbsp;" !!}  <span class="text-muted">{{$section->name_ar}}</span></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    {{-- {{method_field('delete')}} --}}
                                                    <input type="hidden" value="{{$section->id}}" name="id">
                                                    @if($section->image)
                                                        <img src="{{ url('uploads/sections').'/'. $section->image}}" class="w-100" alt ="{{ $section->name }}">
                                                    @endif
                                                    <h4 class="py-2 text-danger">الوصف القصير :
                                                        <br>
                                                         <span class="text-muted">{{ $section->short_description_ar }}</span>
                                                    </h4>
                                                    <h4 class="py-2 text-danger">الوصف :
                                                        <br>
                                                        <p class="my-1 text-muted">{{ $section->description_ar }}</p>
                                                    </h4>
                                                    <hr>
                                                    <p class="mt-2 text-danger">التصنيف التابع له :
                                                        <span class="text-muted">{{ $section->category->name_ar }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            @endcan
                            @can('edit-section')
                                <td>
                                    <a href="{{route('tenant.admin.sections.edit',$section->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('admin.edit_section') }}"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                </td>
                                @endcan

                            @can('delete-section')
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_section{{ $section->id }}" title="{{ trans('admin.delete_section') }}"><i class="fa fa-trash"></i></button>
                                    <!-- Delete Modal -->
                                    <form action="{{route('tenant.admin.sections.destroy',$section)}}" method="section">
                                        <div class="modal fade" id="delete_section{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف قسم من قائمة الأقسام</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> هل انت متأكد من حذف القسم : {{$section->name_ar}} ؟</p>

                                                        @csrf
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$section->id}}" name="id">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin.close') }}</button>
                                                            <button type="submit" name="submit" class="btn btn-danger">{{trans('admin.delete') }}</button>
                                                        </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>


                            @endcan


                            @can('toggle-section')
                                <td>
                                    <a data-toggle="modal" data-target="#change-state-{{$section->id}}" class="btn btn-sm btn-{{$section->active == 1 ? 'success' : 'danger'}} mx-1" title="{{$section->active == 1 ? 'مفعلة' : 'غير مفعلة'}}">
                                        <i class="fa fa-toggle-{{$section->active == 1 ? 'on' : 'off'}}" style="color: #fff";></i>
                                    </a>
                                </td>
                                <!-- Change state modal  -->
                                <form action="{{route('tenant.admin.section.toggle_state',$section->id)}}" method="post">
                                    <div class="modal fade" id="change-state-{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل حالة التفعيل للقسم</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>هل انت متأكد من تعديل حالة التفعيل للقسم  :{{$section->name}}?</p>
                                                    @csrf
                                                    <input type="hidden" value="{{$section->id}}" name="id">
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

    {{-- Pagination --}}
    <div class="d-flex justify-content-center align-items-center my-5">
        {{ $sections-> links() }}
    </div>
</div>




