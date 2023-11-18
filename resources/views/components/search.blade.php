@props(['route'])

<div class="" style="display: flex; justify-content: flex-end; align-items: center;">
    <form action="{{$route[0]}}" > 
        <input name="search" type="text" class="" style="border: 1px solid black; padding: 0.25rem 0.5rem; width: 24rem;">
        <input type="submit" value="Search" class="" style="background-color: rgb(59 130 246); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-weight: bold; height: 100%;">
    </form>
</div>