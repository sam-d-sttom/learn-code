<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tags', 'points', 'duration', 'description'];

    public function scopeFilters($query){
        if(request('search') ?? false){
            $query->where('title', 'like', '%'. request('search') . '%')
            ->orWhere('tags', 'like', '%'. request('search') . '%')
            ->orWhere('description', 'like', '%'. request('search') . '%');
        }
    }

    //relationship with chapters
    public function chapters(){
        return $this->hasMany(Chapter::class, 'course_id');
    }
}
