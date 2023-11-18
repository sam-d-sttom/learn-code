@props(['props'])

<div class="my-5">
    <label class="font-bold" for="{{$props['name']}}">{{$props['label']}}: </label>
    <input class="border py-1 px-2 w-96" type="{{$props['type']}}" placeholder="{{$props['placeholder']}}" name="{{$props['name']}}" />
</div>