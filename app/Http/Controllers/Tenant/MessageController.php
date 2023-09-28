<?php

namespace App\Http\Controllers\Tenant;
use App\Http\Controllers\Controller;
use App\Models\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {

        $messages = Message::latest()->paginate(20);
        return view('tenants_pages.admin.pages.messages.index',compact('messages'));
   
    }

    public function destroy(Request $request)
    {
        try{
            Message::findOrFail($request->id)->delete();
            Alert::success(trans('admin.Post_deleted_successfully'));
            return redirect()->route('tenant.admin.messages.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

}