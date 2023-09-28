
<div class="card-body">
    <div class="table-responsive">
        <!-- Search for clients -->

            <div class="row">
                <div class="col-9 col-sm-12 mt-4">
                    <input type="text" class="form-control my-4 search_term" wire:model='clientInfo' placeholder="إبحث بإسم العميل او البريد الإلكتروني">
                </div> 
            </div>

        <table class="table table-hover mb-0 mt-4 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الأسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>العنوان</th>

                    @can('edit-client')
                        <th>تعديل</th>
                    @endcan
                    @can('delete-client')
                        <th>حذف</th>
                    @endcan
                </tr>
            </thead>
            <tbody id="filtered-results">
                @if($clients)
                    @foreach ($clients as $key=>$client )
                    <div  wire:key="{{$key}}">
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $client->name}}</td>
                            <td>{{ $client->email}}</td>
                            <td>{{ $client->phone}}</td>
                            <td>{{ $client->address}}</td>

                            @can('edit-client')
                                <td>
                                    <a href="{{route('tenant.admin.clients.edit',$client->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                                </td>
                            @endcan

                            @can('delete-client')
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_client{{ $client->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                    <!-- Delete Modal -->
                                    <form action="{{route('tenant.admin.clients.destroy',$client)}}" method="POST">
                                        <div class="modal fade" id="delete_client{{$client->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">حذف عميل من قائمة العملاء</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> هل انت متأكد من حذف العميل : {{$client->name}} ؟</p>

                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- {{method_field('delete')}} --}}
                                                        <input type="hidden" value="{{$client->id}}" name="id">
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
        {{ $clients-> links() }}
    </div>
</div>


