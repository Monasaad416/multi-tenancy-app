<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    protected $categories = [];
    public $catName;

    public function mount()
    {
        $this->categories = Category::latest()->paginate(15);
    }

    public function updatedCatName()
    {
        $this->categories = Category::where('name_ar', 'like', '%'.$this->catName.'%')->latest()->paginate(15);
        //return dd($this->categories);
    }

    public function render()
    {
        return view('livewire.category-component',['categories'=> $this->categories]);
    }
}
