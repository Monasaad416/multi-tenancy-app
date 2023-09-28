
@extends('tenants_pages.admin.layout.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">إضافة مهمة</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('tenant.admin.roles.index')}}" class="default-color">قائمة الباقات</a></li>
                    <li class="breadcrumb-item active">إضافة مهمة</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <br>



                        @include('inc.errors')

                        <form action="{{route('tenant.admin.roles.store')}}" method='post'>
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>اسم المهمة:</strong><span class="text-danger">*</span>
                                        <div class="my-1"></div>
                                        <input type='text' name='name' class='form-control'>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong class="d-block my-2">إختر المهام   :</strong><span class="text-danger">*</span>
                                        <br/>
                                        <input type="checkbox" name="select-all" id="select-all" />
                                        <h5 class="d-inline my-4">إختر الكل</h5>
                                        <br>
                                        @foreach($permission as $value)
                                            <label><input type='checkbox' name='permission[]', value='{{$value->id}}' class= 'name'>
                                            {{ $value->name }}</label>
                                        <br/>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

<script>
    $('#select-all').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});
</script>

@endsection


