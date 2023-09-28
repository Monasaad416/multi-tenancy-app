<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\User;
use PHPUnit\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

class ProfileController extends Controller
{

    public function edit($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('admin.pages.profile.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        try{
            $user = User::findOrFail($request->user()->id);
;
             

            if($request->has('password')) {
                $user->update([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'password'=> Hash::make($request->password),
                ]);
            } else {
                $user->update([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                ]);
            }
        
            Alert::success('تم تعديل ملفك الشخصي بنجاح');
            return redirect()->back();
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

