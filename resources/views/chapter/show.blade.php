@extends('voyager::master')

@section('content')


    @if($hasAccess && $chapter !== null)
    <input id="chapter-content" value="{{$chapter->content}}" style="display: none;"/> 
        <div id="chapter-content-div">
        
        </div>
    @else
        <p>You do not have access to this chapter</p>
    @endif

    <!-- script to properly render the chapter content -->
    <script>
        const chapterContent = document.getElementById('chapter-content');
        const chapterContentDiv = document.getElementById('chapter-content-div');

        chapterContentDiv.innerHTML = chapterContent.value;
    </script>

@stop