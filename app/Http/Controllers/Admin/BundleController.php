<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Http\Requests\BundleStoreRequest;
use App\Http\Requests\BundleUpdateRequest;
use Alert;

class BundleController extends Controller
{   
    public function index()
    {
        $bundles = Bundle::paginate(15);
        return view('admin.pages.bundles.index',compact('bundles'));
    }

    public function create()
    {
        return view('admin.pages.bundles.create');
    }

    public function store(BundleStoreRequest $request)
    {
        try{
            // return dd($request->all());
            Bundle::create([
                'name' => $request->name,
                'payment_system' => $request->payment_system,
                'price' => $request->price,
                'active' =>$request->active == "on" ? 1 : 0 ,
            ]);


            Alert::success(trans('تم إضافة باقة جديدة بنجاح'));

            return redirect()->route('admin.bundles.index');
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
        $bundle = Bundle::findOrFail($id);
        return view('admin.pages.bundles.edit',compact('bundle'));
    }

    public function update(BundleUpdateRequest $request)
    {
        //return dd($request->all());
        $bundle = Bundle::findOrFail($request->bundle_id);
        $bundle->update([
            'name' => $request->name,
            'payment_system' => $request->payment_system,
            'price' => $request->price,
            'active' => $request->active == "on" ? 1 : 0 ,
        ]);


        Alert::success(trans('تم تعديل بيانات الباقة بنجاح'));

        return redirect()->route('admin.bundles.index');
    }
    public function destroy(Request $request)
    {
        try{
            Bundle::findOrFail($request->id)->delete();
            Alert::success('تم حذف الباقة بنجاح');
            return redirect()->route('admin.bundles.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function toggleState(Request $request)
    {
        try{
            $bundle = Bundle::findOrFail($request->id);
            if( $bundle->active == 1 ){
                $bundle->active = 0;
                $bundle->save();

            }else {
                $bundle->active = 1;
                $bundle->save();
            }
            Alert::success('تم تعديل حالة تفعيل الباقة بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
