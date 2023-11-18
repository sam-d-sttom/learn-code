@extends('voyager::master')

@section('content')

<h2>All Courses</h2>

<div class=" p-4 ">
    <x-search :route="['/admin/courses']" />

    <div class="content-container p-4 ">

        @if(count($courses) === 0)
        <p>No course found.</p>
        @endif

        <div class="row">
            @foreach($courses as $course)
            <!-- <div class="!flex justify-between border-b py-2">
            <span class="text-lg">{{$course->title}}</span>
            <a href="courses/{{$course->id}}">
                <button class="bg-blue-500 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">View</button>
            </a>
        </div> -->

            <?php
            $description = '';
            $description_letters = str_split($course->description);
            for ($i = 0; $i < 100; $i++) {
                $description .= $description_letters[$i];
            }
            $description .= "...";

            

            ?>

            <div class="col-sm-6 col-md-4 col-xxl-3">
                <div class="card product-card">
                    <div class="card-img-top">
                        <img src="https://berrydashboard.io/bootstrap/default/assets/images/application/prod-img-1.jpg" alt="image" class="img-prod">
                    </div>
                    <div class="card-body">
                        <a href="courses/{{$course->id}}">
                            <h5 class="mb-0 title">{{$course->title}}</h5>
                        </a>
                        <p class="prod-content my-3 text-muted description">{{$description}}</p>
                        <div class="star">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            <i class="far fa-star text-muted"></i>
                            <span class="text-sm text-muted">(12.99+)</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <h4 class="mb-0"><b>$12.99</b> <span class="text-sm text-muted f-w-400 text-decoration-line-through">$15.99</span></h4>
                            <a href="courses/{{$course->id}}">
                                <button class="btn btn-primary">View course</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>

    <div>
        {{$courses->links('pagination::bootstrap-5')}}
    </div>
</div>

<iframe frameBorder="0" height="450px" src="https://onecompiler.com/embed/html" width="100%"></iframe>

<script defer>
    var titles = document.querySelectorAll(".title");

    titles.forEach(title => {

        var text = title.innerHTML;
        title.innerHTML = "";
        var words = text.split("");
        for (i = 0; i < 20; i++) {
            title.innerHTML += words[i];
        }
        title.innerHTML += "...";
    })
</script>
@stop