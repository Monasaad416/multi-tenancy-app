<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use Alert;

class CreateItemComponent extends Component
{
    public $addedItems = [];


    public function mount()
    {
        $this->addedItems = [
           '',
        ];
    }

    public function addNewItem()
    {
       $this->addedItems[] = '';
    }


    public function removeItem($key)
    {
        unset($this->addedItems[$key]);
        //shift element to keep order of index 0,1,2,....(reorder)
        $this->addedItems = array_values($this->addedItems);
        //return dd($this->addedItems);
    }

    public function submit() {
        foreach($this->addedItems as $key=> $item) {
            $oldItem = Item::where('name',$item)->first();
            if(!$oldItem){
                Item::create([
                    'name' => $item,
                ]);
            }
        }


        if(count($this->addedItems) == 1 ) {
            Alert::success('تم إضافة بند جديد بنجاح');
        } else {
            Alert::success('تم إضافة بنود جديدة بنجاح');
        }
        
       

        return redirect()->route('admin.items.index');
    }

    public function render()
    {
        info($this->addedItems);
        return view('livewire.create-item-component');
    }
}
