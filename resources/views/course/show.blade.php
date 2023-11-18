@extends('voyager::master')

@section('content')

<x-style />



<?php
$tags = explode(',', $course->tags);
?>

<div style="display: flex; justify-content: space-around;">
    <div style="display: flex; width: 50%; padding: 0.25rem 0.5rem; border-radius: 0.5rem; box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.5);">
        <div style=" width: 35%;">
            <img src="https://berrydashboard.io/bootstrap/default/assets/images/application/prod-img-1.jpg" alt="image" class="img-prod" style="border-radius: 0.5rem;">
        </div>
        <div style=" width: 65%; padding: 0.5rem 1rem">
            <h4 style="font-weight: bold;">{{$course->title}}</h4>
            <p>{{$course->description}}</p>
            <div>
                @foreach($tags as $tag)
                <span style="border-radius: 1rem; background: rgb(59 130 246); padding: 0.25rem 0.5rem; color: white; ">{{$tag}}</span>
                @endforeach
            </div>
            <p>Course points: {{$course->points}}</p>
            <p>Course duration: {{$course->duration}}</p>
            <div class="!flex justify-between w-36">
                <a href="/admin/courses/{{$course->id}}/edit">
                    <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Edit</button>
                </a>

                <form method="POST" action="/admin/courses/{{$course->id}}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="bg-red-500 hover:bg-blue-500 text-white font-bold py-1 px-2 rounded">
                </form>
            </div>
        </div>

    </div>
</div>

<div>
    <h3>Chapters</h3>
    <div class="p-4 ">

        <div style="font-size: 1.125rem; line-height: 1.75rem; display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; font-weight: bold;">
            <span>Chapter number</span>
            <div style="display: flex; justify-content: space-between; width: 75%;">
                <span>Title</span>
                <span>Action</span>
            </div>
        </div>

        @if(count($chapters) === 0)
        <p>This book currently has no chapters.</p>
        @endif

        @foreach($chapters as $chapter)
        <div style="display: flex; justify-content: space-between; border-bottom-width: 1px; padding: 0.5rem 0;">
            <span style="margin-right: 100px;">Chapter {{$chapter['chapter_number']}}</span>
            <div  style="display: flex; justify-content: space-between; width:75%;">
                <span style="margin-right: 100px;">{{$chapter['title']}}</span>
                <div>
                    @if($chapter['hasAccess'])
                    <a href="/admin/courses/{{$course->id}}/chapters/view?chapter_number={{$chapter['chapter_number']}}">
                        <button class=" btn" >View</button>
                    </a>
                    @else
                    <a href="/admin/courses/{{$course->id}}/chapters/pay?chapter_number={{$chapter['chapter_number']}}&coins_needed={{$chapter['coins_needed']}}">
                        <button class="btn">Pay to view</button>
                    </a>
                    @endif

                    <a href="/admin/courses/{{$course->id}}/chapters/edit?chapter_number={{$chapter['chapter_number']}}">
                        <button class="btn">Edit</button>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="/admin/courses/{{$course->id}}/chapters/create">
        <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-1 px-2 rounded">Add new chapter</button>
    </a>
</div>
@stop