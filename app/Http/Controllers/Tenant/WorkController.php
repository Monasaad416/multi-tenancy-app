<?php

namespace App\Http\Controllers\Tenant;

use Exception;
use App\Models\Work;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkStoreRequest;
use Carbon\Carbon;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $works = Work::latest()->paginate(20);
        return view('tenants_pages.admin.pages.works.index',compact('works'));
    }


    public function create()
    {
        return view('tenants_pages.admin.pages.works.create');
    }


    public function store(WorkStoreRequest $request)
    {
        //return dd($request->all());
        try{
            if($request->image){
                $image = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$image;
                $path = 'uploads/works';
                $request->image->move($path, $fileName);
            }
            $slug = Str::slug($request->title_en);

            Work::create([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'section_id' => $request->section_id,
                'image' => $fileName ?? null ,
                'finishing_date' => Carbon::parse($request->finishing_date),
            ]);


            Alert::success('تم إضافة عمل جديد بنجاح');

            return redirect()->route('tenant.admin.works.index');
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
        return view('Work::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        return view('tenants_pages.admin.pages.works.edit',compact('work'));
    }

    public function update(Request $request)
    {
        //return dd($request->all());
        $work = Work::findOrFail($request->work_id);



        $slug = Str::slug($request->title_en);

        $work->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'short_description_en' => $request->short_description_en,
            'short_description_ar' => $request->short_description_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'section_id' => $request->section_id,
            'finishing_date' => Carbon::parse($request->finishing_date),
        ]);

        if($request->hasFile('image')){
            if ($work->image && file_exists(public_path('uploads/works/' . $work->image))) {
                unlink(public_path('uploads/works/' . $work->image));
            }
            $fileExtension = $request->image->getClientOriginalExtension();
            $fileName = time().'.'.$fileExtension;
            $path = 'uploads/works';
            $request->image->move($path, $fileName);

            $work->update([
                'image' => $fileName,
            ]);
        }


        Alert::success('تم تعديل  العمل بنجاح');

        return redirect()->route('tenant.admin.works.index');
    }
    public function destroy(Request $request)
    {
        try{
            Work::findOrFail($request->id)->delete();
            Alert::success('تم حذف العمل بنجاح');
            return redirect()->route('tenant.admin.works.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
