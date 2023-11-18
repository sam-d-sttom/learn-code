@extends('voyager::master')

@section('content')

<form class="pl-5" method="POST" action="/admin/courses" enctype="multipart/form-data">
    @csrf

    <x-input :props="['name' => 'title', 'label' => 'Title', 'placeholder' => 'Course title', 'type' => 'text']"/>

    <div class="!flex  ">
        <label class="mr-2 font-bold" for="description">Description: </label>
        <textarea class="border py-1 px-2 w-96" name="description" id="" cols="30" rows="10" placeholder="Course description"></textarea>
    </div>

    <x-input :props="['name' => 'tags', 'label' => 'Tags', 'placeholder' => 'Course tags', 'type' => 'text']"/>
    <x-input :props="['name' => 'points', 'label' => 'Points', 'placeholder' => 'Course points', 'type' => 'number']"/>
    <x-input :props="['name' => 'duration', 'label' => 'Duration', 'placeholder' => 'Course duration', 'type' => 'number']"/>

    <input type="submit" value="Save" class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"/>
</form>

@stop