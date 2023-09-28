<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;

class MessageComponent extends Component
{
    public function render()
    {
        $messages = Message::latest()->paginate(20);
        return view('livewire.message-component',compact('messages'));
    }
}
