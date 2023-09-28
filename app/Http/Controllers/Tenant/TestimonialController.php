<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(20);
        return view('tenants_pages.admin.pages.testimonials.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants_pages.admin.pages.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            Testimonial::create([
                'client_name' => $request->client_name,
                'review' => $request->review,
            ]);
            Alert::success(trans('تم إضافة رأي جديد بنجاح'));
            return redirect()->route('tenant.admin.testimonials.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
       public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('tenants_pages.admin.pages.testimonials.edit',compact('testimonial'));
    }

    public function update(Request $request)
    {
        //return dd($request->all());
        $testimonial = testimonial::findOrFail($request->testimonial_id);



        $testimonial->update([
            'client_name' => $request->client_name,
            'review' => $request->review,
        ]);

        Alert::success('تم تعديل الرأي بنجاح');

        return redirect()->route('tenant.admin.testimonials.index');
    }
    public function destroy(Request $request)
    {
        try{
            Testimonial::findOrFail($request->id)->delete();
            Alert::success('تم حذف الرأي بنجاح');
            return redirect()->route('tenant.admin.testimonials.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
