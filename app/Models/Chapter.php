<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'chapter_number', 'content', 'course_id', 'coins_needed', 'xp_earned'];


    //relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->latest('id')->filters(request(['search']))->paginate(10);
    }
}
