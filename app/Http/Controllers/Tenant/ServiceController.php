<?php

namespace App\Http\Controllers\Tenant;

use Alert;
use Exception;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;

class ServiceController extends Controller
{
    public function index(Request $request)
    {

        $services = Service::latest()->paginate(20);
        return view('tenants_pages.admin.pages.services.index',compact('services'));
        
    }
    public function create()
    {
        return view('tenants_pages.admin.pages.services.create');
    }

    public function store(ServiceStoreRequest $request)
    {
        try{
            if($request->image){
                $image = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$image;
                $path = 'uploads/services';
                $request->image->move($path, $fileName);
            }
            $slug = Str::slug($request->name_en);

            Service::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'category_id' => $request->category_id,
                'section_id' => $request->section_id,
                'slug' => $slug,
                'price' =>$request->price,
                'image' =>$fileName ?? null ,
                'active' =>$request->active == "on" ? 1 : 0 ,
            ]);


            Alert::success('تم إضافة خدمة جديد بنجاح');

            return redirect()->route('tenant.admin.services.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('Service::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('tenants_pages.admin.pages.services.edit',compact('service'));
    }

    public function update(Request $request)
    {
        //return dd($request->all());
        $service = Service::findOrFail($request->service_id);




        $slug = Str::slug($request->name_en);

        $service->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'short_description_en' => $request->short_description_en,
            'short_description_ar' => $request->short_description_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'category_id' => $request->category_id,
            'section_id' => $request->section_id,
            'slug' => $slug,
            'price' =>$request->price,
            'active' =>$request->active == "on" ? 1 : 0 ,
        ]);

        if($request->hasFile('image')){
            //Delete old image
            if ($service->image && file_exists(public_path('uploads/services/' . $service->image))) {
                unlink(public_path('uploads/services/' . $service->image));
            }

            //new image upload
            $fileExtension = $request->image->getClientOriginalExtension();
            $fileName = time().'.'.$fileExtension;
            $path = 'uploads/services';
            $request->image->move($path, $fileName);

            //Save new image
            $service->image = $fileName;
            $service->save();
        }

        Alert::success('تم تعديل بيانات الخدمة بنجاح');

        return redirect()->route('tenant.admin.services.index');
    }
    public function destroy(Request $request)
    {
        try{
            Service::findOrFail($request->id)->delete();
            Alert::success('تم حذف الخدمة بنجاح');
            return redirect()->route('tenant.admin.services.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    
    public function toggleState(Request $request)
    {
        try{
            $service = Service::findOrFail($request->id);
            if( $service->active == 1 ){
                $service->active = 0;
                $service->save();

            }else {
                $service->active = 1;
                $service->save();
            }
            Alert::success('تم تعديل حالة تفعيل الخدمة بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
