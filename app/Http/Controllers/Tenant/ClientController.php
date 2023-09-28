<?php

namespace App\Http\Controllers\Tenant;

use Alert;
use Exception;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;

class ClientController extends Controller
{

public function index(Request $request)
{
        
    return view('tenants_pages.admin.pages.clients.index');
}


    public function create()
    {
        return view('tenants_pages.admin.pages.clients.create');
    }


    public function store(ClientStoreRequest $request)
    {
        try{
            // return dd($request->all());
            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,

            ]);


            Alert::success(trans('تم إضافة  عميل جديد بنجاح'));

            return redirect()->route('tenant.admin.clients.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id) {
        
    }



    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('tenants_pages.admin.pages.clients.edit',compact('client'));
    }

    public function update(ClientUpdateRequest $request)
    {
        //return dd($request->all());
        $client = Client::findOrFail($request->client_id);


        $client->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

        Alert::success(trans('تم تعديل بيانات العميل بنجاح'));

        return redirect()->route('tenant.admin.clients.index');
    }
    public function destroy(Request $request)
    {
        try{
            Client::findOrFail($request->id)->delete();
            Alert::success('تم حذف العميل بنجاح');
            return redirect()->route('tenant.admin.clients.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
