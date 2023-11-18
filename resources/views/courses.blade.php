@extends('voyager::master')

@section('content')
    <p>Hello world. This is where you get your courses.</p>

    <!-- Create the editor container -->
    
    <form method="POST" action="/chapter/create" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Chapter title" />
        <input type="number" placeholder="Chapter number" />
        <div id="editor"></div>
        <input type="submit" value="Save" />
    </form>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
@stop