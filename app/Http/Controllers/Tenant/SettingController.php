<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
use App\Http\Requests\SettingUpdateRequest;
use Exception;
class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate();
        //return dd($settings);
        return view('tenants_pages.admin.pages.settings.edit',['settings'=>$settings]);
    }
    public function update(SettingUpdateRequest $request)
    {
        try{

            $settings = Setting::first();

            if($request->hasFile('favicon')) {

                //Delete old image
                if ($settings->favicon && file_exists(public_path('uploads/settings/' . $settings->favicon))) {
                    unlink(public_path('uploads/settings/' . $settings->favicon));
                }

                //new image upload
                $faviconExtension = $request->favicon->getClientOriginalExtension();
                $faviconName = time().'.'.$faviconExtension;
                $path = 'uploads/settings';
                $request->favicon->move($path, $faviconName);

                $settings->update([
                    'favicon' => $faviconName,
                ]);
            }

            if($request->hasFile('logo')) {
                //Delete old image
                if ($settings->logo && file_exists(public_path('uploads/settings/' . $settings->logo))) {
                    unlink(public_path('uploads/settings/' . $settings->logo));
                }

                //new image upload
                $logoExtension = $request->logo->getClientOriginalExtension();
                $logoName = time().('_').'.'.$logoExtension;
                $path = 'uploads/settings';
                $request->logo->move($path, $logoName);


                $settings->update([
                    'logo' => $logoName,
                ]);
            }

            $settings->update([
                'title_ar' => $request->title_ar,
                'title_en'=> $request->title_en,
                'address_ar' => $request->address_ar,
                'address_en' => $request->address_en,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'phone3' => $request->phone3,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
            ]);

            Alert::success('تم تحديث إعدادات الموقع بنجاح');
            return redirect()->route('tenant.admin.settings.edit');

        }catch (Exception $e) {
            return redirect()->route('admin.settings.edit')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
