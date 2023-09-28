<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostComponent extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $posts = Post::latest()->paginate(20);
        return view('livewire.post-component',compact('posts'));
    }
}
