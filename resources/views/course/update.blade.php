@extends('voyager::master')

@section('content')

<form method="POST" action="/admin/courses/{{$course->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Title: </label>
        <input type="text" placeholder="Course title" name="title" value="{{$course->title}}" />
    </div>

    <div>
        <label for="descrition">Description: </label>
        <input type="text" placeholder="Course description" name="description" value="{{$course->description}}" />
    </div>

    <div>
        <label for="tags">Tags: </label>
        <input type="text" placeholder="Course tags" name="tags" value="{{$course->tags}}" />
    </div>

    <div>
        <label for="points">Points</label>
        <input type="number" placeholder="Course points" name="points" value="{{$course->points}}" />
    </div>

    <div>
        <label for="duration">Duration: </label>
        <input type="number" placeholder="Course duration" name="duration" value="{{$course->duration}}" />
    </div>

    <input type="submit" value="Save">
</form>

<a href="/admin/courses/{{$course->id}}"><button>Back</button></a>

@stop