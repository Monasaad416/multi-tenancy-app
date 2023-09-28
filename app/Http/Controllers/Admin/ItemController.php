<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use Alert;

class ItemController extends Controller
{
  public function index(Request $request)
    {
        $items = Item::paginate(15);
        return view('admin.pages.items.index',compact('items'));
    }

    public function create()
    {
        return view('admin.pages.items.create');
    }


    public function store(Request $request)
    {
        //handled using livewire
    }

    public function edit($id)
    {
        $item = item::find($id);
        return view('admin.pages.items.edit',compact('item'));
    }

    public function update(Request $request)
    {
        try {
            $item = item::find($request->item_id);
            $item->update([
                'name' => $request->name,
            ]);
            Alert::success('تم تحديث البند بنجاح');
            return redirect()->route('admin.items.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        try{
            Item::findOrFail($request->id)->delete();
            Alert::success('تم حذف البند بنجاح');
            return redirect()->route('admin.items.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
