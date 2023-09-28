<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionComponent extends Component
{

    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    protected $sections = [];
    public $category_id;
    public $section_name;

    public function mount()
    {
        $this->sections = Section::latest()->paginate(15);
    }

    public function updatedCategoryId()
    {
        //$this->resetPage();
        $this->sections = Section::where('category_id', $this->category_id)->latest()->paginate(15);
        //return dd($this->sections);
    }

    public function updatedSectionName()
    {
        //$this->resetPage();
        $this->sections = Section::where('name_ar', 'like', '%'.$this->section_name.'%')->paginate(15);
        //return dd($this->sections);
    }

    public function render()
    {
        return view('livewire.section-component',['sections'=> $this->sections]);
    }
}
