<?php

namespace App\Http\Controllers\Tenant;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('tenants_pages.admin.Users.index');

    }


    public function create()
    {
        return view('tenants_pages.admin.users.create');
    }


    public function store(UserStoreRequest $request)
    {
        try{
            // return dd($request->all());
            $slug = Str::slug($request->name_en);

            if($request->image){
                $image = $request->image->getUserOriginalExtension();
                $fileName = time().'.'.$image;
                $path = 'uploads/users';
                $request->image->move($path, $fileName);
            }


            User::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'parent_id' => $request->parent_id,
                'image' =>  $fileName ?? null,
                'slug' => $slug,

            ]);


            Alert::success(trans('تم إضافة تصنيف جديد بنجاح'));

            return redirect()->route('tenant.admin.Users.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $User = User::findOrFail($id);
        return view('tenants_pages.admin.Users.edit',compact('User'));
    }

    public function update(UserUpdateRequest $request)
    {
        //return dd($request->all());
        $User = User::findOrFail($request->User_id);
        $slug = Str::slug($request->name_en);

        if($request->image){
            $image = $request->image->getUserOriginalExtension();
            $fileName = time().'.'.$image;
            $path = 'uploads/Users';
            $request->image->move($path, $fileName);
        }

        $User->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'parent_id' => $request->parent_id,
                'image' => $fileName ?? null,
                'slug' => $slug,
                'active' => $request->active,
            ]);

        Alert::section_deleted_successfully(trans('تم تعديل بيانات التصنيف بنجاح'));

        return redirect()->route('tenant.admin.Users.index');
    }
    public function destroy(Request $request)
    {
        try{
            User::findOrFail($request->id)->delete();
            Alert::success('تم حذف التصنيف بنجاح');
            return redirect()->route('tenant.admin.Users.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function searchByUser(Request $request)
    {
        $query = $request->get('query');
        $Users = User::where('name_ar', 'like', '%'.$query.'%')->orWhere('name_en', 'like', '%'.$query.'%')->get();
        if (!$Users) {
            // User not found, return an empty result set
            $Users = collect();
        } else {
            // User found, get the Users for the User
            $Users = $Users;
        }

        $data = [];

        foreach ($Users as $User) {
            $data[] = [
                'id' => $User->id,
                'name_en' => $User->name_en,
                'name_ar' => $User->name_ar,
                'parent' => $User->parent ? $User->parent->name : null,
            ];
        }

        return response()->json([
            'Users' => $data,
        ]);
    }
}
