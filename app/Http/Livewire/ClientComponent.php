<?php

namespace App\Http\Livewire;


use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientComponent extends Component
{    
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    protected $clients = [];
    public $clientInfo;

    public function mount()
    {
        $this->clients = Client::latest()->paginate(15);
    }

    public function updatedClientInfo()
    {
        $this->clients = Client::where('name', 'like', '%'.$this->clientInfo.'%')->orWhere('email', 'like', '%'.$this->clientInfo.'%')->latest()->paginate(15);
        //return dd($this->clients);
    }

    public function render()
    {
        return view('livewire.client-component',['clients'=> $this->clients]);
    }
}
