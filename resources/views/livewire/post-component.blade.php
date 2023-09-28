
<div class="card-body">
    <div class="table-responsive">
            <!-- Search for posts -->
            <input type="text" class="form-control my-4 search" wire:model="search_post" placeholder="إبحث بعنوان المقال">
     
            <table class="table table-hover mb-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الكاتب</th>
                    <th>الصورة</th>

                    @can('show-post')
                        <th>التفاصيل</th>
                    @endcan
        
                    @can('delete-post')
                        <th>حذف</th>
                    @endcan

                    @can('toggle-post')
                        <th>حالة التفعيل</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="filtered-results">
                @if($posts)
                    @foreach ($posts as $post )
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title_ar}}</td>
                            <td>{{ $post->author}}</td>


                            <td>{{ $post->image ? $post->image : '---'}}</td>
                            {{-- <td>{{ $post->specialist->name_ar }}</td> --}}


                            @can('show-post')
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#show_post{{ $post->id }}" title="تفاصيل المقال"><i class="fa fa-eye"></i></button>
                                    <!-- Show Modal -->
                                    <form action="{{route('tenant.admin.posts.show',$post)}}" method="POST" >
                                        <div class="modal fade" id="show_post{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="text-primary d-block">عرض تفاصيل المقال  {{$post->title_ar}}</h5>
                                                
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p></p>

                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$post->id}}" name="id">
                                                        @if($post->image)
                                                            <img src="{{ url('uploads/posts').'/'. $post->image}}" class="w-100" alt ="{{ $post->name }}">
                                                        @endif
                                                        <h5>{{ $post->short_description_ar }}</h5>
                                                        <h4>{{ $post->body_ar }}</h4>

                                                        <p class="text-muted ">كتب بواسطة :  {{$post->author}}</p>
                                                        <p class="text-muted ">كتب في :  {{Carbon\Carbon::parse($post->created_at)->format('d M ,Y')}}</p>
                                                        {{-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                        </div> --}}
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>


                            @endcan
                            {{-- @can('edit-post')
                                <td>
                                    <a href="{{route('tenant.admin.posts.edit',$post->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                </td>
                            @endcan --}}

                            @can('delete-post')
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_post{{ $post->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                    <!-- Delete Modal -->
                                    <form action="{{route('tenant.admin.posts.destroy',$post)}}" method="POST">
                                        <div class="modal fade" id="delete_post{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف تصنيف من قائمة المقالات</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> هل انت متأكد من حذف المقال : {{$post->title_ar}} ؟</p>

                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$post->id}}" name="id">
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


                            
                        @can('toggle-post')
                            <td>
                                <a data-toggle="modal" data-target="#change-state-{{$post->id}}" class="btn btn-sm btn-{{$post->active == 1 ? 'success' : 'danger'}} mx-1" title="{{$post->active == 1 ? 'مفعلة' : 'غير مفعلة'}}">
                                    <i class="fa fa-toggle-{{$post->active == 1 ? 'on' : 'off'}}" style="color: #fff";></i>
                                </a>
                            </td>
                            <!-- Change state modal  -->
                            <form action="{{route('tenant.admin.post.toggle_state',$post->id)}}" method="POST">
                                <div class="modal fade" id="change-state-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل حالة التفعيل للمقال</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>هل انت متأكد من تعديل حالة التفعيل للمقال  :{{$post->name}}?</p>
                                                @csrf
                                                <input type="hidden" value="{{$post->id}}" name="id">
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
        {{ $posts-> links() }}
    </div>
</div>




