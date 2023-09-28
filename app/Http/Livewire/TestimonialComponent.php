<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Testimonial;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TestimonialComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $testimonials = Testimonial::latest()->paginate(20);
        return view('livewire.testimonial-component',compact('testimonials'));
    }
}
