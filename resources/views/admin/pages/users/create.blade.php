@extends('tenants_pages.admin.layout.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
     <div class="page-title">
        <div class="row">
            <div class="col-sm-6 mt-4 mb-3">
                <h4 class="mb-0"> إضافة موظف</h4>
            </div>
            <div class="col-sm-6 mt-4 mb-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}" class="default-color">قائمة الموظفين</a></li>
                    <li class="breadcrumb-item active">إضافة موظف</li>
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
                            <form method="post" action={{ route('admin.users.store')}}>
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for='name'>إسم الموظف </label><span class="text-danger">*</span>
                                            <input type='text' name='name' value="{{ old('name') }}"  class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم الموظف">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='email'>البريد الإلكتروني</label><span class="text-danger">*</span>
                                            <input type='email' name='email' value="{{ old('email') }}" class= 'form-control  mt-1 mb-3 @error('email') is-invalid @enderror' placeholder = "البريد الإلكتروني">
                                        </div>
                                    </div>
                                    <span class="text-danger mt-2 mb-1">ادخل كلمة سر مؤقتة سوف يقوم الموظف بتغييرها لاحقا </span>
                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label for='password'>كلمة السر</label><span class="text-danger">*</span>
                                            <input type='password' name='password'  value="{{ old('password') }}"  class= 'form-control mt-1 mb-3 @error('password') is-invalid @enderror' placeholder = "كلمة السر">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='password_confirmation'>تأكيد كلمة السر</label><span class="text-danger">*</span>
                                            <input type='password' name='password_confirmation' value="{{ old('password_confirmation') }}" class= 'form-control  mt-1 mb-3 @error('password_confirmation') is-invalid @enderror' placeholder = "تأكيد كلمة السر">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for='phone'>الهاتف</label>
                                            <input type='text' name='phone' value="{{ old('phone') }}" class= 'form-control mt-1 mb-3 @error('phone') is-invalid @enderror' placeholder = "الهاتف">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for='address'>المهمة</label>
                                            <select name="roles_name[]" class="form-control" multiple>
                                                <option value="">--إختر المهمة--</option>
                                                @foreach(Spatie\Permission\Models\Role::all() as $role)
                                                    <option value={{ $role->name}}>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button value="submit" class ='btn btn-primary btn-flat' >حفظ</button>
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
@endsection

