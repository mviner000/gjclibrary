<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <title>GJCLibrary - About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome/fontawesome.min.css">
    <link rel="stylesheet" href="css/font-awesome/brands.min.css">
    <link rel="stylesheet" href="css/font-awesome/solid.min.css">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background-image: url({{ asset('images/left-vector.png') }});
            background-size: 30px
            background-position: left;
            background-repeat: no-repeat; /* Ito ay upang maiwasan ang pag-ulit ng background image */
        }
    </style>
</head>
<body>
<div id="main">

@if(Request::is('small-devices'))
    @include('components.navbar', ['navbarTitle' => config('app.name', 'GJCLibrary')])
@else
    @include('components.navbar', ['navbarTitle' => 'Library Admin Panel'])
@endif

    <div class="container mt-5" >
        <h1 class="text-center">About the Library</h1>
        <h3 class="text-center fs-10,  font-weight-bold color: #00914c; font-family: Lato, Arial; font-weight: 400; vertical-align: baseline; font-size: 1.5em; font-weight: normal;">General Objective</h3>
        <p class="text-justify">
            <h5 style="font-size: 1.5em; font-weight: normal;">This website presents the catalogue of books available at the GJC Library. 
            Here, you may 'time-in' or 'time-out' your library attendance, and plan (in advance) to 'take-out' any book that you need to borrow.
            You may also post your own reviews of the books you've read, and engage in dialogue with fellow readers.
            </h5>
        </p>

        <p class="text-justify" style="font-size: 1.5em; font-weight: normal; text-align: center; font-family: 'Times New Roman', Arial; font-style: italic; font-weight: 700; vertical-align: baseline;" >
            <br>The chief purpose of GJC Library is to serve the faculty, students, staff, and administrators of GJC in
                their academic tasks.
            </br>
        </p>
        <p class="text-justify" style="font-size: 1.5em; font-weight: normal;">
            To give quality services by providing information and resources that will enhance the
            realization of the vision, mission, and philosophy of the college. The GJC Library recognizes its vital role
            as an indispensable and functional instrument for quality instruction and research. The library aims to
            support instruction provided by the faculty and enriches learning of students in terms of assigned tasks and
            research works. Its organization, facilities, and library resources are geared towards dynamic and quality
            services to its clients.
        </p>
        <h3 class="text-center fs-10,  font-weight-bold color: #00914c; font-family: Lato, Arial; font-weight: 400; vertical-align: baseline; font-size: 1.5em; font-weight: normal;">Brief History of GJC Library</h3>

        
        <div class="row">
            <div class="col-md-6">
                <p class="text-justify" style="font-size: 1.5em; font-weight: normal;">
                    The school, which was founded in 1946, started in a rented building which was the former residence of the
                    Moreno family with 6 rooms. One was the Principal’s Office and Teachers’ Room. Adjacent to it were the library 
                    and laboratory, separated by a thin sawali partition. The library was far from being conducive to study because 
                    it was used as a classroom. What with the crowded space and the noise of the recitations going on, students had no 
                    other alternatives but do the studying and reading elsewhere. The other three rooms were classrooms. Like the library 
                    and laboratory, they were separated from each other by sawali partitions that served not even to muffle the voices in each class.
                </p>
            </div>
            <div class="col-md-6">
                <img class="mt-2" src="{{ asset('images/gen_simeon.jpg') }}" style="width: 100%; height: auto;" alt="Image">
            </div>
        </div>
        
        <p class="text-justify" style="font-size: 1.5em; font-weight: normal;">
            After 5 years, the new building of General de Jesus Academy sprawled on A. Vallarta St. in San Isidro, Nueva
            Ecija upon its own lot. The building frontage by a new shingle with the Silver Star, Torch, and Book – our
            pledge to the institution and her trust to us – served as the main features. When formerly the school had
            six rooms, now she has nine (9). Interesting to all are the laboratory and library. In the former is
            gathered costly instruments and chemicals, chart, and specimens – the joy of any eager scientist. The
            library occupying a corner room with windows on both outward sides, literally overflows with maps and
            charts. Sets of encyclopedias, classical and modern literature, magazines, and newspapers – all these, the
            delight of any literary enthusiast the library has. And now, the library is in the true sense of a library.
            It is devoted solely to reading and study.
        </p>
        <p class="text-justify" style="font-size: 1.5em; font-weight: normal;">
            GJC recognizes the vital role of the library in fulfilling the educational requirements of the students;
            hence, it continues to be a part of the online learning community even during the pandemic. With the
            resuming of face-face learning, the library will continue to serve its clientele with a hyflex
            (hybrid-flexible) learning. This is a combination of onsite and offsite access to available library
            resources.
        </p>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    defer></script>
<script nomodule
    src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="{{ asset('js/script.js') }}" defer></script>

</body>
</html>
