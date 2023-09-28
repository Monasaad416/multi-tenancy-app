<?php
namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    protected $users = [];
    public $userInfo;

    public function mount()
    {
        $this->users = User::latest()->paginate(15);
    }

    public function updatedUserInfo()
    {
        $this->users = User::where('name', 'like', '%'.$this->userInfo.'%')->orWhere('email', 'like', '%'.$this->userInfo.'%')->latest()->paginate(15);
        //return dd($this->users);
    }

    public function render()
    {
        return view('livewire.user-component',['users'=> $this->users]);
    }
}