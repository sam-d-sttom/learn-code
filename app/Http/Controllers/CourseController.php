<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\ChapterServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    //Show all courses
    public function index()
    {
        return view('course.index', [
            'courses' => Course::latest('id')->filters(request(['search']))->paginate(12)
        ]);
    }

    //show single course
    public function show(Course $course, ChapterServices $chapterServices)
    {
        $user_id = Auth::id();

        $chapters_array = [];

        foreach ($course->chapters as $chapter) {
            $hasAccess = $chapterServices->hasAccess($chapter->coins_needed, $course->id, $chapter->chapter_number, $user_id);

            array_push($chapters_array, array(
                'title' => $chapter->title,
                'chapter_number' => $chapter->chapter_number,
                'coins_needed' => $chapter->coins_needed,
                'hasAccess' => $hasAccess
            ));
        }

        return view('course.show', [
            'course' => $course,
            'chapters' => $chapters_array
        ]);
    }

    //Show create course form
    public function create()
    {
        return view('course.create');
    }

    //store course
    public function store(Request $request, Course $course)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'points' => 'required',
            'duration' => 'required'
        ]);

        $course->create($formFields);

        return back();
    }

    //show edit course form
    public function edit(Course $course)
    {
        return view('course.update', [
            'course' => $course
        ]);
    }

    //update course
    public function update(Request $request, Course $course)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'points' => 'required',
            'duration' => 'required'
        ]);

        $course->update($formFields);

        return back();
    }

    //delete course
    public function delete(Course $course)
    {
        $course->delete();
        return redirect('/admin/courses');
    }
}
