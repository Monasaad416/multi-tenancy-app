<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pages.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {

        try{
            DB::beginTransaction();
            //return dd($request->input('roles_name'));
           // return dd($request->all());
            if($request->hasFile('image')) {
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/users';
                $request->image->move($path, $fileName);

                $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->password),
                        'image' => $fileName,
                        'department_id' => $request->department_id,
                        'branch_id' => $request->branch_id,
                        'roles_name' => $request->roles_name,
                        // 'salary' => $request->amount ? $request->amount : 0,
                ]);

                $user->assignRole($request->input('roles_name'));
            } else {
               $user= User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->password),
                        'department_id' => $request->department_id,
                        'branch_id' => $request->branch_id,
                        'roles_name' => $request->roles_name,
                ]);


                foreach($request->roles_name as $role);{
                    $user->assignRole([$role]);
                }
                
            }

            DB::commit();

            Alert::success('تم إضافة موظف جديد بنجاح');
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pages.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        try{
            $user = User::findOrFail($request->user_id);
            $user->update($request->all());
        
            Alert::success('تم تعديل بيانات الموظف بنجاح');
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        //return dd($user);
        //remove image from storage


        // Salary::where('salariable_type','App\Models\User')->where('salariable_id', $user->id)->first()->delete();



        $user->delete();
        Alert::success('تم حذف بيانات الموظف  بنجاح.');
        return redirect()->route('admin.users.index');
    }


}
