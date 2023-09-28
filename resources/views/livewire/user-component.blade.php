<div class="card-body">
    <div class="table-responsive">
        <!-- Search for users -->
   
            <div class="row">
                <div class="col-9 col-sm-12 mt-4">
                    <input type="text" class="form-control my-4 search_term" wire:model='userInfo' placeholder="إبحث بإسم الموظف او البريد الإلكتروني">
                </div> 
            </div>

        <table class="table table-hover mb-0 mt-4 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الأسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>المهمة</th>

                    @can('edit-user')
                        <th>تعديل</th>
                    @endcan
                    @can('delete-user')
                        <th>حذف</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="filtered-results">
                @if($users)
                    @foreach ($users as $key=>$user )
                    <div  wire:key="{{$key}}">
                        <tr>
                            <th scope="row">{{ $loop->iteration}}</th>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->phone ? $user->phone : '---'}}</td>
                            <td>
                                @foreach($user->roles_name as $role)
                                    <p>
                                        {{$role}}
                                    </p>
                                @endforeach
                            </td>

                            @can('edit-user')
                                <td>
                                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                </td>    
                            @endcan
                            @can('delete-user')   
                                <td>     
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_user{{ $user->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                    <!-- Delete Modal -->
                                    <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                        <div class="modal fade" id="delete_user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف موظف من قائمة الموظفين</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> هل انت متأكد من حذف الموظف : {{$user->name}}؟</p>

                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$user->id}}" name="id">
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
                        </div>
                    @endforeach
                @else
                    <p>لايوجد بيانات للعرض</p>
                @endif

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center align-items-center my-5">
        {!! $users->links() !!}
    </div>
</div>