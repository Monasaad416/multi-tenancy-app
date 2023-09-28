<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $services = [];
    public $catName;

    public function mount()
    {
        $this->services = Service::latest()->paginate(15);
    }

    public function updatedCatName()
    {
        $this->services = Service::where('name_ar', 'like', '%'.$this->catName.'%')->latest()->paginate(15);
        //return dd($this->services);
    }

    public function render()
    {
        return view('livewire.service-component',['services'=> $this->services]);
    }
}
