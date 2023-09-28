<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = ['id','created_at','updated_at'];

    public function scopeActive($query) {
        $query->where('active',1);
    }

    
}
