@extends('voyager::master')

@section('content')

    @if($chapter === null)
    <p>No chapter found</p>
    @else
    
    <form method="POST" action="/admin/chapters/{{$chapter->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="my-5" >
            <label class="font-bold" for="title">Chapter title: </label>
            <input class="border py-1 px-2 w-96" type="text" placeholder="Chapter title" value="{{$chapter->title}}" name="title"/>
        </div>

        <div class="my-5">
            <label class="font-bold" for="chapter_number">Chapter number: </label>
            <input type="number" placeholder="Chapter number" value="{{$chapter->chapter_number}}" name="chapter_number"/>
        </div>
        <div class="my-5" id="editor" ></div>
        <input style="display: none;" name="content" id="edited-input" value="{{$chapter->content}}"/>
        <input type="submit" value="Save" id="submit" class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"/>
    </form>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        const editedInput = document.querySelector('#edited-input');
       
        //assigning the content stored in the database to be the content that would be edited by the database.
        quill.root.innerHTML = editedInput.value;

        //on submit of the form, edited content from the editor would be assigned to the hidden input to be sent with the request
        const submit = document.querySelector('#submit');
        submit.addEventListener('click', ()=>{
            editedInput.value = quill.root.innerHTML;
        })
    </script>

    @endif
@stop