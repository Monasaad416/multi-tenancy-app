<?php
namespace App\Http\Controllers\Tenant;

use Alert;
use Exception;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionStoreRequest;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        return view('tenants_pages.admin.pages.sections.index'); 
    }


    public function create()
    {
        return view('tenants_pages.admin.pages.sections.create');
    }


    public function store(SectionStoreRequest $request)
    {
        try{
            if($request->image){
                $image = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$image;
                $path = 'uploads/sections';
                $request->image->move($path, $fileName);
            }
            $slug = Str::slug($request->name_en);
            Section::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'price' =>$request->price,
                'image' =>$fileName ?? null ,
                'active' =>$request->active == "on" ? 1 : 0 ,
            ]);


            Alert::success(trans('تم إضافة قسم جديد بنجاح'));

            return redirect()->route('tenant.admin.sections.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        return view('section::show');
    }


    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('tenants_pages.admin.pages.sections.edit',compact('section'));
    }

    public function update(Request $request)
    {
        //return dd($request->all());
        $section = Section::findOrFail($request->section_id);

            $slug = Str::slug($request->name_en);

            $section->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'price' =>$request->price,
                'active' =>$request->active == "on" ? 1 : 0 ,
            ]);

            
            if($request->hasFile('image')){

                //delete old image
                if ($section->image && file_exists(public_path('uploads/sections/' . $section->image))) {
                    unlink(public_path('uploads/sections/' . $section->image));
                }

                //new image upload
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/sections';
                $request->image->move($path, $fileName);

                //save new image
                $section->image = $fileName;
                $section->save();
            }

        Alert::success(trans('تم تعديل بيانات القسم بنجاح'));

        return redirect()->route('tenant.admin.sections.index');
    }


    public function destroy(Request $request)
    {
        try{
            Section::findOrFail($request->id)->delete();
            Alert::success(trans('admin.section_deleted_successfully'));
            return redirect()->route('tenant.admin.sections.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getSectionsByCategory($category_id)
    {
        $listOfSections = Section::where('category_id',$category_id)->pluck('name_ar','id');
        return response()->json($listOfSections);
    }



    
    public function toggleState(Request $request)
    {
        try{
            $section = Section::findOrFail($request->id);
            if( $section->active == 1 ){
                $section->active = 0;
                $section->save();

            }else {
                $section->active = 1;
                $section->save();
            }
            Alert::success('تم تعديل حالة تفعيل القسم بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
