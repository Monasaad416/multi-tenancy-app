<?php

namespace App\Http\Livewire;

use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;

class WorkComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $works = Work::latest()->paginate(20);
        return view('livewire.work-component',compact('works'));
    }
}
