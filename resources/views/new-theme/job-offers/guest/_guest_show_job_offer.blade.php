<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet" >

    <title>@lang("Job Offer") {{ $offer->title }}</title>
</head>
<body>
<div class="container">

    <form class="row" method="post" action="{{ route("job-offer.guest.answer",$offer->form_link) }}" enctype="multipart/form-data">
        @csrf
        @method("post")
        <h1 class="text-center">@lang("Job Offer") {{ $offer->title }}</h1>
        <div>
            <p>job type : {{ $offer->job_type }}</p>
            <p>experience : {{ $offer->experience }}</p>
            <p>career level : {{ $offer->career_level }}</p>
            <p>salary : {{ $offer->salary }}</p>
        </div>
        <div class="mb-3 mt-3">
            <label for="exampleInputEmail1" class="form-label">CV</label>
            <input type="file" name="cv" class="form-control" id="exampleInputEmail1">
            @include("new-theme.components.error1",['error'=>'cv'])
        </div>

        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name :</label>
            <input type="text" name="name" class="form-control" id="name">
            @include("new-theme.components.error1",['error'=>'name'])
        </div>
        @foreach($offer->sections as $section)
            <div class="card m-1">
                <div class="card-header">
                    <p>{{ $section->title }}</p>
                </div>
                <div class="card-body">
                    @foreach($section->questions as $question)
                        @include("new-theme.job-offers.guest.question")
                        <hr>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button class="btn btn-success btn-sm">Submit</button>
    </form>
</div>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>

