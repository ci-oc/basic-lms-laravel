<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCI-H Module</title>
    <link rel="stylesheet" href="{{ asset('welcome/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display">
    <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Rajdhani" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mallanna" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('welcome/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('welcome/css/styles.css')}}">

    <style type="text/css">
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .links > a {
            color: #fff;
            background-color: #f7776e;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 35px;
            border: thin solid #555555;
            padding: 10px 15px 10px 15px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links > a:hover {
            padding: 15px;
            background-color: #0EBCF3;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            transition: 0.5s;
        }

    </style>
</head>

<body>
<div class="container-fluid main-header-text">
    <div class="top-header-container">
        <div id="home" class="header-cell"
             style="background-image:url({{asset('welcome/img/DD-Starry-Night-Sky-Scene-64536-Preview.jpg')}});height:667px;">
            <div class="top-right links">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('/dashboard') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Login</a>
                        @endif
                    </div>
                @endif
            </div>
            <h1 style="font-family:'Rajdhani', sans-serif; letter-spacing: 2px;"><span
                        style="color: #0EBCF3;">FCI-H</span> Learning management System</h1>
            <p style="font-family:'Rajdhani', sans-serif; font-size: 20px;">Easy Communication Between Instructors and
                Students which allaws them to make and participate in Courses, create and solve Quizzes with amazing
                Features, Let's see them ...</p>
        </div>
    </div>
    <nav id="navbar_middle" class="navbar navbar-default nav-main-wrapper"
         style="font-family: 'Rajdhani', sans-serif; font-weight: bolder;">
        <div class="container">
            <div class="navbar-header"><a class="navbar-brand visible-xs-block navbar-link" href="#">MENU </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span
                            class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="active" role="presentation"><a href="#home">Home </a></li>
                    <li role="presentation"><a href="#features">Features </a></li>
                    <li role="presentation"><a href="#team">Team </a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="team-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-center" id="features" style="font-family:'Mallanna';">OUR FEATURES</h2></div>
        <div class="row people">
            <div class="col-md-4 col-sm-6 item"><img class="img-circle" src="{{asset('welcome/img/7627.jpg')}}">
                <h3 class="name">Responsive Designes</h3>
                <p class="description">Responsive Designs for any devices like large computers, laptops, ipads, and
                    mobile phones. </p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/school and education 03.jpg')}}">
                <h3 class="name">Creating New Courses</h3>
                <p class="description">Instructors can create their Courses and add students easly with just an excel
                    sheet which contains their Data, or adding students one by one manually.</p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/97350-OKYIEE-393.jpg')}}">
                <h3 class="name">Creating &amp; Sloving Quizzes</h3>
                <p class="description">The System provides a way for making and solving Quizzes with two types of
                    Questions (MCQ questions &amp; Coding Problems). </p>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle" src="{{asset('welcome/img/images.jpg')}}">
                <h3 class="name">Automatic Marking</h3>
                <p class="description">Professors just provide us with an excel sheet contains student's name &amp; id,
                    then every student will get his grades automatically. </p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/chart_diagram_analytics_business_flat_icon-512.png')}}">
                <h3 class="name">Statistics and Charts </h3>
                <p class="description">The System provides Statistics for students, Courses, and Faculty. It can
                    generate useful defferent statistics </p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/feedback-1311638_960_720.png')}}">
                <h3 class="name">Get your Feedback! </h3>
                <p class="description">Our System will till you about your weak points according to your mistakes in
                    your Quizzes. (Coming Soon ..)</p>
            </div>
        </div>
    </div>
</div>
<div class="team-grid" id="team">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Founders</h2>
            <p class="text-center">We are all your mates in FCI-H. This Project was made under supervision of Professor.
                Ghada Khoriba and Professor. Insaf Huessain</p>
        </div>
        <div class="row people">
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/andrew.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Andrew Nagyeb</h3>
                        <p class="title">Developer </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/eyad.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Eyad Shokry</h3>
                        <p class="title">Developer </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/mina.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Mina Mofreh</h3>
                        <p class="title">developer </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/yassen.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Yassen Mehrez</h3>
                        <p class="title">developer </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="testimonials"></section>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h5>FCI-H Learning Management System© 2017</h5></div>
            <div class="col-sm-6 social-icons"><a href="#"><i class="fa fa-github"></i></a></div>
        </div>
    </div>
</footer>
<script src="{{asset('welcome/js/jquery.min.js')}}"></script>
<script src="{{asset('welcome/bootstrap/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        "use strict"
        $(window).on("scroll", function () {
            var scroll_value = $(window).scrollTop();
            console.log(scroll_value);
            if (scroll_value > 618) {
                $('#navbar_middle').css('top', scroll_value + "px");
                $('#navbar_middle').css('z-index', 4);
            } else {
                $('#navbar_middle').css('top', 618 + "px");
            }
        })
    })
</script>
</body>

</html>