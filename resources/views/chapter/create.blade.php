@extends('voyager::master')

@section('content')

    <!-- Create the editor container -->
    
    <form method="POST" action="/admin/courses/{{$course->id}}/chapters" enctype="multipart/form-data">
        @csrf

        <x-input :props="['name' => 'title', 'label' => 'Chapter title', 'placeholder' => 'Chapter title', 'type' => 'text']"/>
        <x-input :props="['name' => 'coins_needed', 'label' => 'Coins needed', 'placeholder' => 'Coins needed', 'type' => 'number']"/>
        <x-input :props="['name' => 'xp_earned', 'label' => 'Xp earned', 'placeholder' => 'Xp earned', 'type' => 'number']"/>
        <div>
            <label for="chapter_number">Chapter number: </label>
            <input type="number" placeholder="Chapter number"  name="chapter_number"/>
        </div>
        <div id="editor"></div>
        <input type="hidden" name="content" id="edited-input" />
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

        //on submit of the form, edited content from the editor would be assigned to the hidden input to be sent with the request
        const submit = document.querySelector('#submit');
        submit.addEventListener('click', ()=>{
            editedInput.value = quill.root.innerHTML;
        })
    </script>
@stop