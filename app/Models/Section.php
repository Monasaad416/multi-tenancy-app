<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    public function scopeActive($query) {
        $query->where('active',1);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

}
