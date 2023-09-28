<?php

namespace App\Http\Controllers\Tenant;

use Alert;
use Exception;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $posts = Post::latest()->paginate(20);
        return view('tenants_pages.admin.pages.posts.index',compact('posts'));
   
    }


    // public function create()
    // {
    //     return view('tenants_pages.admin.pages.posts.create');
    // }


    // public function store(PostStoreRequest $request)
    // {
    //     try{
    //         $slug = Str::slug($request->name_en);

    //         Post::create([
    //             'title_en' => $request->title_en,
    //             'title_ar' => $request->title_ar,
    //             'short_description_en' => $request->short_description_en,
    //             'short_description_ar' => $request->short_description_ar,
    //             'body_en' => $request->body_en,
    //             'body_ar' => $request->body_ar,
    //             'category_id' => $request->category_id,
    //             'author' =>Auth::user()->name,
    //             'image' => $request->image,
    //             'video_title' => $request->video_title,
    //             'video_path' => $request->video_path,
                

    //         ]);


    //         Alert::success(trans('تم إضافة مقال جديد بنجاح'));

    //         return redirect()->route('tenant.admin.posts.index');
    //     } catch (Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('Post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    // public function edit($id)
    // {
    //     $post = Post::findOrFail($id);
    //     return view('tenants_pages.admin.pages.posts.edit',compact('Post'));
    // }

    // public function update(Request $request)
    // {
    //     //return dd($request->all());
    //     $post = Post::findOrFail($request->id);
    //     $posts = Post::
    //         select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','parent_id')
    //         ->latest()->paginate(20);
    //     $post->update([
    //             'name_en' => $request->name_en,
    //             'name_ar' => $request->name_ar,
    //             'description_en' => $request->description_en,
    //             'description_ar' => $request->description_ar,
    //             'parent_id' => $request->parent_id,
    //         ]);

    //     Alert::info(trans('تم تعديل بيانات المقال بنجاح'));

    //     return redirect()->route('tenant.admin.posts.index');
    // }
    public function destroy(Request $request)
    {
        try{
            Post::findOrFail($request->id)->delete();
            Alert::success(trans('admin.Post_deleted_successfully'));
            return redirect()->route('tenant.admin.posts.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    
    public function toggleState(Request $request)
    {
        $post = Post::findOrFail($request->id);
        try{
            if( $bundle->active == 1 ){
                $bundle->active = 0;
                $bundle->save();

                $post->active = 1;
            }else {
                $bundle->save();
            }
            Alert::success('تم تعديل حالة تفعيل المقال بنجاح');
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}