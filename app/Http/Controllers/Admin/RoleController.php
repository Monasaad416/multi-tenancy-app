<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Alert;

class RoleController extends Controller
{
  public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('admin.pages.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.pages.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            // 'monthly_price' => 'nullable|numeric',
            // 'annual_price' => 'nullable|numeric',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            // 'monthly_price' => $request->input('mo'),
            // 'annual_price' => $request->input('annual_price'),
        ]);
        $role->syncPermissions($request->input('permission'));


        // $oldPermissions = $role->permissions()->pluck('name')->toArray();
        // $newPermissions = [
        //     'posts-list',
        //     'create-post',
        //     'edit-post',
        //     'delete-post',
        //     'show-post',
        //     'services-list',
        //     'create-service',
        //     'edit-service',
        //     'delete-service',
        //     'show-service',
        //     'categories-list',
        //     'create-category',
        //     'edit-category',
        //     'delete-category',
        //     'show-category',
        //     'edit-setting',
        //     'sections-list',
        //     'create-section',
        //     'edit-section',
        //     'delete-section',
        //     'show-section',
        //     'messages-list',
        //     'delete-message',
        //     'show-message',
        // ];

        // foreach ($newPermissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // $mergedPermissions = array_unique(array_merge($oldPermissions, $newPermissions));
        // $role->syncPermissions($mergedPermissions);

        Alert::success('تم إضافة مهمة جديدة بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('admin.pages.roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.pages.roles.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        Alert::success('تم تحديث المهمة بنجاح');
        return redirect()->route('admin.roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        Alert::success('تم حذف المهمة بنجاح');
        return redirect()->route('admin.roles.index');
    }
}

