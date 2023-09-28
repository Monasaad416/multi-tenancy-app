<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Throwable;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;





class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.pages.tenants.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createNewTenant($request) {
        $request->validate([
            'subdomain' => 'required|string|max:255',
        ]);

        //return dd($request->all());
        $tenant = Tenant::create([
            'id' => $request->subdomain,
            'bundle_id' => $request->bundle_id,
        ]);

        $tenant->domains()->create(['domain' => $request->subdomain . '.business.test']);

        // Set the database connection to the tenant's database
        config(['database.default' => 'tenant']);
        DB::purge('tenant');
        DB::reconnect('tenant');

        // Create a new user for the tenant
        $user = new User;
        $user->setConnection('tenant');
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt(12345678);
        $user->roles_name = ["admin"] ;
        $user->save();

        Role::create([
            'name' => "admin",
        ]);

        $permissions = [
            'posts-list',
            'create-post',
            'edit-post',
            'delete-post',
            'show-post',
            'toggle-post',

            'services-list',
            'create-service',
            'edit-service',
            'delete-service',
            'show-service',
            'toggle-service',

            'categories-list',
            'create-category',
            'edit-category',
            'delete-category',
            'show-category',
            'toggle-category',

            'edit-setting',

            'sections-list',
            'create-section',
            'edit-section',
            'delete-section',
            'show-section',
            'toggle-section',

            'messages-list',
            'delete-message',
            'show-message',

            'testimonials-list',
            'create-testimonial',
            'edit-testimonial',
            'delete-testimonial',
            'show-testimonial',

            'works-list',
            'create-work',
            'edit-work',
            'delete-work',
            'show-work',

            'users-list',
            'create-user',
            'edit-user',
            'delete-user',
            'show-user',

            'clients-list',
            'create-client',
            'edit-client',
            'delete-client',
            'show-client',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach ($user->roles_name as $role) {
            $user->assignRole([$role]);
            $newRole = Role::where('name',$role)->first();
            $newRole->syncPermissions($permissions);
        }


    }
    public function create()
    {
        return view("admin.pages.tenants.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $this->createNewTenant($request);

            Alert::success('تم إضافة مشترك جديد بنجاح');
            return redirect()->route('admin.tenants.index');

        }  catch (Throwable $error) {
            return $error;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('admin.pages.tenants.edit',compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{

            $tenant = Tenant::findOrFail($request->tenant_id);
            $request->validate([
                'subdomain' => 'nullable|string|max:255',
                'bundle_id' => 'exists:bundles,id',
            ]);

            if($request->subdomain != null) {
                //delete old tenant with its domain and database
                $tenant->delete();
                //create new tenant with new domain and databse
                 $this->createNewTenant($request);

            }
            $tenant->update([
                'bundle_id' => $request->bundle_id,
            ]);

            Alert::success('تم تعديل بيانات المشترك بنجاح');
            return redirect()->route('admin.tenants.index');

        }  catch (Throwable $error) {
            return $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $tenant = Tenant::findOrFail($request->tenant_id);
        $tenant->delete();

        Alert::success('تم حذف المشترك وقاعدة البيانات  بنجاح');
        return redirect()->route('admin.tenants.index');
    }
}
