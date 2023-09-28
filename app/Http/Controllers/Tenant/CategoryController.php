<?php

namespace App\Http\Controllers\Tenant;

use Alert;
use Exception;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('tenants_pages.admin.pages.categories.index');
    }



    public function create()
    {
        return view('tenants_pages.admin.pages.categories.create');
    }


    public function store(CategoryStoreRequest $request)
    {
        try{
            // return dd($request->all());
            $slug = Str::slug($request->name_en);

            if($request->image){
                $image = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$image;
                $path = 'uploads/categories';
                $request->image->move($path, $fileName);
            }


            Category::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'parent_id' => $request->parent_id,
                'image' =>  $fileName ?? null,
                'slug' => $slug,
                'active' =>$request->active == "on" ? 1 : 0 ,
            ]);


            Alert::success(trans('تم إضافة تصنيف جديد بنجاح'));

            return redirect()->route('tenant.admin.categories.index');
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
        $category = Category::findOrFail($id);
        return view('tenants_pages.admin.pages.categories.edit',compact('category'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        //return dd($request->all());
        $category = Category::findOrFail($request->category_id);
        $slug = Str::slug($request->name_en);



        $category->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'short_description_en' => $request->short_description_en,
                'short_description_ar' => $request->short_description_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'parent_id' => $request->parent_id,
                'slug' => $slug,
                'active' => $request->active == "مفعل" ? 1 : 0,
            ]);

            if($request->hasFile('image')){

                //Delete old image
                if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                    unlink(public_path('uploads/categories/' . $category->image));
                }

                //new image upload
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/categories';
                $request->image->move($path, $fileName);

                //save new image
                $category->image = $fileName;
                $category->save();
            }

        Alert::success(trans('تم تعديل بيانات التصنيف بنجاح'));

        return redirect()->route('tenant.admin.categories.index');
    }
    public function destroy(Request $request)
    {
        try{
            Category::findOrFail($request->id)->delete();
            Alert::success('تم حذف التصنيف بنجاح');
            return redirect()->route('tenant.admin.categories.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    
    public function toggleState(Request $request)
    {
        try{
            $category = Category::findOrFail($request->id);
            if( $category->active == 1 ){
                $category->active = 0;
                $category->save();

            }else {
                $category->active = 1;
                $category->save();
            }
            Alert::success('تم تعديل حالة تفعيل التصنيف بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
