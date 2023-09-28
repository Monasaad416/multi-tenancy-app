<div class="card-body">
    <div class="table-responsive">
       <input type="text" class="form-control my-4 search" wire:model="catName" placeholder="إبحث بإسم التصنيف">

        <table class="table table-hover mb-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الأسم</th>
                    <th>التصنيف الرئيسي</th>

                    @can('show-category')
                        <th>التفاصيل</th>
                    @endcan
                    @can('edit-category')
                        <th>تعديل</th>
                    @endcan
                    @can('delete-category')
                        <th>حذف</th>
                    @endcan
                    @can('toggle-category')
                        <th>حالة التفعيل</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="filtered-results">
                @if($categories)
                    @foreach ($categories as $category )
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $category->name_ar}}</td>


                            <td>{{ $category->parent ? $category->parent->name_ar : '---'}}</td>
                            {{-- <td>{{ $category->specialist->name_ar }}</td> --}}


                            @can('show-category')
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#show_category{{ $category->id }}" title="تفاصيل التصنيف"><i class="fa fa-eye"></i></button>
                                    <!-- Show Modal -->
                                    <form action="{{route('tenant.admin.categories.show',$category)}}" method="POST" >
                                        <div class="modal fade" id="show_category{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 id="exampleModalLabel"><span class="text-muted"> إسم التصنيف :</span> {!! "&nbsp;" !!} {{$category->name_ar}} </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p></p>

                                                        @csrf
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$category->id}}" name="id">
                                                        @if($category->image)
                                                            <div class="py-2">
                                                                <img src="{{ url('uploads/categories').'/'. $category->image}}" class="w-100" alt ="{{ $category->name }}">
                                                            </div>
                                                        @endif

                                                        <h4 class="text-muted">الوصف القصير باللغة العربيه </h4>
                                                        <p>{{ $category->short_description_ar  ? $category->short_description_ar  : 'لايوجد'}}</p>
                                                        <hr>



                                                        <h4 class="text-muted">الوصف القصير باللغة الإنجليزية </h4>
                                                        <p>{{ $category->short_description_ar ? $category->short_description_ar : 'لا يوجد'}}</p>
                                                        <hr>


                                                        <h4 class="text-muted">الوصف باللغة العربيه</h4>
                                                        <p>{{ $category->description_ar ? $category->description_ar : 'لا يوجد'}}</p>

                                                        <hr>

                                                        <h4 class="text-muted">الوصف باللغة الإنجليزية</h4>
                                                        <p>{{ $category->description_ar ? $category->description_ar : 'لا يوجد'}}</p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>


                            @endcan
                            @can('edit-category')
                                <td>
                                    <a href="{{route('tenant.admin.categories.edit',$category->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                </td>
                            @endcan

                            @can('delete-category')
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_category{{ $category->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                    <!-- Delete Modal -->
                                    <form action="{{route('tenant.admin.categories.destroy',$category)}}" method="POST">
                                        <div class="modal fade" id="delete_category{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف تصنيف من قائمة التصنيفات</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> هل انت متأكد من حذف التصنيف : {{$category->name_ar}} ؟</p>

                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$category->id}}" name="id">
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

                            @can('toggle-category')
              
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




