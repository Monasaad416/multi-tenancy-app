<div class="card-body">
    <div class="table-responsive">
        <!-- Search for services -->
        <input type="text"  class="form-control my-4 search_term" wire:model="domainName" placeholder="بحث  بإسم الدومين">
        <table class="table table-hover mb-0 text-md-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الدومين </th>
                    <th>الباقة</th>
                    <th>تعديل </th>
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody id="filtered-results">
                @foreach ($tenants as $tenant )
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $tenant->id }}</td>
                        <td>{{ $tenant->bundle->name }}</td>

                        <td>
                            <a href="{{route('admin.tenants.edit',$tenant->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل بيانات المشترك"><i class="fa fa-edit text-white" aria-hidden="true"></i></a>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_tenant{{ $tenant->id }}" title="حذف المشترك"><i class="fa fa-trash"></i></button></td>

                            <form action="{{route('admin.tenants.destroy',$tenant->id)}}" method="POST">
                                <div class="modal fade" id="delete_tenant{{$tenant->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حذف مشترك من قائمة المشتركين وحذف قاعد البيانات الخاصة به</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">

                                            <p>هل انت متاكد من حذف المشترك : {{ $tenant->id }} </p>
                                            @csrf
                                            @method('delete')

                                            <input type="hidden" value="{{$tenant->id}}" name="tenant_id">
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
        <div class="d-flex justify-content-center align-items-center my-5">
            {{ $tenants-> links() }}
        </div>
    </div>
</div>