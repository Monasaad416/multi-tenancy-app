<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenant;

class TenantComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $tenants = [];
    public $domainName;

    public function mount()
    {
        $this->tenants = Tenant::latest()->paginate(15);
    }

    public function updatedDomainName()
    {
        $this->tenants = Tenant::where('id', 'like', '%'.$this->domainName.'%')->latest()->paginate(15);
     
    }

    public function render()
    {
        return view('livewire.tenant-component',['tenants'=> $this->tenants]);
    }
}

