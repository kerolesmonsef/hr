<?php

\Carbon\Carbon::setLocale('en');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Job Offers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600;700&display=swap"
          rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet"/>
    <!--  -->

    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/global.css') }}"/>
    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/sections.css') }}"/>
    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/jobOffers.css') }}"/>
    <!--  -->
</head>

<body>
<div class="containerS1">
    <div class="headerApp">
        <div class="row g-4">
            <div class="col-sm-4 col-lg-3">
                <div class="logo">
                    <img src="/new-theme/icons/logo2.svg" alt=""/>
                </div>
            </div>
            <div class="col-sm-8 col-lg-9">
                <form action="">
                    <div class="search">
                        <input type="text" placeholder="Search...."/>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect width="24" height="24" fill="white"/>
                            <path
                                d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                fill="#868686"/>
                            <path
                                d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                fill="#868686"/>
                            <path
                                d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                fill="#868686"/>
                            <path
                                d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                fill="#868686"/>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="indexPage">
        <div class="pageS1">
            <div class="banner" style="background-color: #066163">
                <h1>
                    We Are
                    <span>Hiring !</span>
                </h1>
                <p>Our team Need a new member !</p>
            </div>
            <div class="jobs">
                <div class="row">
                    @foreach($offers as $offer)
                        <div class="col-lg-6" style="cursor: pointer">
                            <div class="job" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $offer->id }}">
                                <div class="head">
                                    <div>
                                        <h2>{{ $offer->title }}</h2>
                                        <div class="location">{{ $offer->location }}</div>
                                    </div>
                                    <div class="jobType">{{ $offer->job_type }}</div>
                                </div>
                                <div class="content">
                                    <div class="date">Posted {{ (new \Carbon\Carbon($offer->start_date))->diffForHumans() }}</div>
                                    <p>{{ $offer->job_description }}</p>
                                </div>
                            </div>
                        </div>
                        @include("new-theme.job-offers.components.guest_job_offer_modal")
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->


<script src="{{ asset("js/bootstrap.bundle.min.js") }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{ asset("js/jquery-3.6.1.min.js") }}"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

</body>

</html>