<!DOCTYPE html>
<style>

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-weight: 300;
    }

    body {
        font-family: 'Source Sans Pro', sans-serif;
        color: white;
        font-weight: 300;
    }

    body ::-webkit-input-placeholder {
        font-family: 'Source Sans Pro', sans-serif;
        color: white;
        font-weight: 300;
    }

    body ::-moz-placeholder {
        font-family: 'Source Sans Pro', sans-serif;
        color: white;
        opacity: 1;
        font-weight: 300;
    }

    body :-ms-input-placeholder {
        font-family: 'Source Sans Pro', sans-serif;
        color: white;
        opacity: 1;
        font-weight: 300;
    }

    .contenido1 {
        position: absolute;
        width: 100%;
        height: 917px;
        margin-top: -300px;
        overflow: hidden;
    }

    .containerr {
        max-width: 600px;
        margin: 0 auto;
        height: 1500px;
    }

    .burbujas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .burbujas li {
        position: absolute;
        list-style: none;
        display: block;
        text-align: center;
        color: white;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, .7);
        background-color: rgba(255, 255, 255, 0.3);
        bottom: -160px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, .5);
        -webkit-animation: square 25s infinite;
        -moz-animation: square 25s infinite;
        animation: square 25s infinite;
        -webkit-transition-timing-function: linear;
        -moz-transition-timing-function: linear;
        transition-timing-function: linear;
    }

    .burbujas li span {
        position: absolute;
        display: block;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        width: 90%;
        height: 90%;
        background-color: rgba(255, 255, 255, .15);
    }

    .burbujas li:nth-child(1) {
        left: 10%;

    }

    .burbujas li:nth-child(2) {
        left: 20%;
        width: 80px;
        height: 80px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, 0);
        -webkit-animation-delay: 2s;
        -moz-animation-delay: 2s;
        animation-delay: 2s;
        -webkit-animation-duration: 17s;
        -moz-animation-duration: 17s;
        animation-duration: 17s;
    }

    .burbujas li:nth-child(3) {
        left: 25%;
        -webkit-animation-delay: 4s;
        -moz-animation-delay: 4s;
        animation-delay: 4s;
    }

    .burbujas li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, .2);
        -webkit-animation-duration: 22s;
        -moz-animation-duration: 22s;
        animation-duration: 22s;
        background-color: rgba(255, 255, 255, .25);
    }

    .burbujas li:nth-child(5) {
        left: 70%;
    }

    .burbujas li:nth-child(6) {
        left: 80%;
        width: 130px;
        height: 130px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, 0);
        -webkit-animation-delay: 3s;
        -moz-animation-delay: 3s;
        animation-delay: 3s;
        background-color: rgba(255, 255, 255, .22);
    }

    .burbujas li:nth-child(7) {
        left: 32%;
        width: 160px;
        height: 160px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, 0);
        -webkit-animation-delay: 7s;
        -moz-animation-delay: 7s;
        animation-delay: 7s;
    }

    .burbujas li:nth-child(8) {
        left: 55%;
        width: 20px;
        height: 20px;
        -webkit-animation-delay: 15s;
        -moz-animation-delay: 15s;
        animation-delay: 15s;
        -webkit-animation-duration: 40s;
        -moz-animation-duration: 40s;
        animation-duration: 40s;
    }

    .burbujas li:nth-child(9) {
        left: 65%;
        width: 35px;
        height: 35px;
        -webkit-animation-delay: 2s;
        -moz-animation-delay: 2s;
        animation-delay: 2s;
        -webkit-animation-duration: 40s;
        -moz-animation-duration: 40s;
        animation-duration: 40s;
        background-color: rgba(255, 255, 255, .3);
    }

    .burbujas li:nth-child(10) {
        left: 90%;
        width: 160px;
        height: 160px;
        box-shadow: 0 0 20px 1px rgba(255, 255, 255, 0);
        -webkit-animation-delay: 11s;
        -moz-animation-delay: 11s;
        animation-delay: 11s;
    }

    @-webkit-keyframes square {
        0% {
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            transform: translateY(0);
        }
        100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
            -moz-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
        }
    }

    @keyframes square {
        0% {
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            transform: translateY(0);
        }
        100% {
            -webkit-transform: translateY(-700px) rotate(600deg);
            -moz-transform: translateY(-700px) rotate(600deg);
            transform: translateY(-700px) rotate(600deg);
        }
    }

    .bg-animado-blue {
        background-color: #0770ac;
        background: -webkit-linear-gradient(24deg, #7be9fb, #0770ac, #23b9ff);
        background: -moz-linear-gradient(24deg, #7be9fb, #0770ac, #23b9ff);
        background: linear-gradient(24deg, #7be9fb, #0770ac, #23b9ff);
        background-size: 600% 100%;
        -webkit-animation: AnimationName 11s ease infinite;
        -moz-animation: AnimationName 11s ease infinite;
        animation: AnimationName 11s ease infinite;
    }

    @-webkit-keyframes AnimationName {
        0% {
            background-position: 0% 50%
        }
        50% {
            background-position: 100% 48%
        }
        100% {
            background-position: 0% 50%
        }
    }

    @keyframes AnimationName {
        0% {
            background-position: 0% 50%
        }
        50% {
            background-position: 100% 48%
        }
        100% {
            background-position: 0% 50%
        }
    }
</style>

<div class="contenido1 bg-animado-blue">
    <div class="containerr">
    </div>
    <ul class="burbujas">
        <li><span>C++</span></li>
        <li><span>C</span></li>
        <li><span>Java</span></li>
        <li><span>SQL</span></li>
        <li><span>PHP</span></li>
        <li><span>code</span></li>
        <li><span>FCIH</span></li>
        <li><span>Quizzes</span></li>
        <li><span>solve</span></li>
        <li><span>Courses</span></li>
    </ul>
</div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
            </div>
            <!--------------login form-------------->
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   autofocus>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            <hr>
            <div class="text-center form-group">
                <form class="form-horizontal" id="guest" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input id="email" type="hidden" class="form-control" name="email"
                           value="guest@guest.x"
                           required>
                    <input id="password" type="hidden" class="form-control" name="password"
                           value="secret" required>
                    <button class="btn-link" type="submit">Login as guest</button>
                </form>
            </div>
            <!--------------end login form-------------->
        </div>

    </div>
</div>
<div class="container-fluid main-header-text">
    <div class="top-header-container">
        <div id="home" class="header-cell"
             style="height:667px;">
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
                    <li role="presentation">
                        @if (Route::has('login'))
                            @if (Auth::check())
                                <a style="color:#0EBCF3;" href="{{ url('/dashboard') }}">Dashboard</a>
                            @else
                                <button onclick="$('#myModsal').modal({'backdrop': 'static'});"
                                        style="color:#0EBCF3; background-color:inherit; border:none;" type="button"
                                        data-toggle="modal" data-target="#myModal">Login
                                </button>
                            @endif
                        @endif
                    </li>
                    <li>
                        @if ($errors->has('email'))
                            <span style="font-family: 'Droid Sans Mono Dotted';color:#802420; margin-left: 10%;">
                              <strong><i class="fa fa-exclamation-triangle"
                                         aria-hidden="true"></i> {{ $errors->first('email') }}!</strong>
                            </span>
                        @endif
                        @if ($errors->has('password'))
                            <span class="alert alert-danger">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="team-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-center" id="features" style="font-family:'Mallanna';">FEATURES</h2></div>
        <div class="row people">
            <div class="col-md-4 col-sm-6 item"><img class="img-circle" src="{{asset('welcome/img/7627.jpg')}}">
                <h3 class="name">Responsive Designes</h3>
                <p class="description">Web Application has the same view for all devices.</p>
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
                <p class="description">Create online quizzes for students with a certain duration, start date and due
                    date.</p>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle" src="{{asset('welcome/img/images.jpg')}}">
                <h3 class="name">Online Judge</h3>
                <p class="description">System provides online judge feature for quizzes which runs C/C++ and
                    sandboxing.</p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/chart_diagram_analytics_business_flat_icon-512.png')}}">
                <h3 class="name">Statistics and Charts </h3>
                <p class="description">Statistics for your course including hardest question, how many got the full mark
                    and a lot more.</p>
            </div>
            <div class="col-md-4 col-sm-6 item"><img class="img-circle"
                                                     src="{{asset('welcome/img/feedback-1311638_960_720.png')}}">
                <h3 class="name">Get your Feedback! </h3>
                <p class="description">UNDER CONSTRUCTION</p>
            </div>
        </div>
    </div>
</div>
<div class="team-grid" id="team">
    <div class="container">
        <div class="intro">
            <div class="form group">
                <h2 class="text-center">Founders</h2>
                <strong class="text-center">This Project was developed under supervision of</strong>
                <hr>
                <ul>
                    <li>
                        Professor/ Insaf Huessain
                    </li>
                    <li>
                        <a href="http://www.fcih.net/ghada/" target="_blank">Assistant Professor/ Ghada Khoriba.</a>
                    </li>

                    <li>
                        Assistant Lecturer/ Ahmed Farrag
                    </li>
                    <li>
                        Teaching Assistant/ Wael Eid
                    </li>
                </ul>
            </div>
        </div>
        <div class="row people">
            <div class="col-md-3 col-sm-4 item">
                <div class="box"
                     style="background-image:url({{asset('welcome/img/andrew.jpeg')}}); background-position: center bottom">
                    <div class="cover">
                        <h3 class="name">Andrew Nagyeb</h3>
                        <p class="title">Developer </p>
                        <ul>
                            <a href="https://github.com/andrewnagyeb"><i style="font-size: 35px;" class="fa fa-github"
                                                                         aria-hidden="true"></i></a>--
                            <a href="https://eg.linkedin.com/in/anagyeb"><i style="font-size: 35px;"
                                                                            class="fa fa-linkedin"
                                                                            aria-hidden="true"></i></a>--
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/eyad.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Eyad Shokry</h3>
                        <p class="title">Developer </p>
                        <ul>
                            <a href="https://github.com/EyadMShokry"><i style="font-size: 35px;" class="fa fa-github"
                                                                        aria-hidden="true"></i></a>--
                            <a href="https://www.linkedin.com/in/eyad-shokry-2289bb124/"><i style="font-size: 35px;"
                                                                                            class="fa fa-linkedin"
                                                                                            aria-hidden="true"></i></a>--
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/mina.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Mina Tawfeek</h3>
                        <p class="title">developer </p>
                        <ul>
                            <a href="https://github.com/MinaMofreh"><i style="font-size: 35px;" class="fa fa-github"
                                                                       aria-hidden="true"></i></a>--
                            <a href="#"><i style="font-size: 35px;" class="fa fa-linkedin" aria-hidden="true"></i></a>--
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 item">
                <div class="box" style="background-image:url({{asset('welcome/img/yassen.jpg')}})">
                    <div class="cover">
                        <h3 class="name">Yassen Mehrez</h3>
                        <p class="title">developer </p>
                        <ul style="line-width: 20px;">
                            <a href="https://github.com/YassenHatem"><i style="font-size: 35px;" class="fa fa-github"
                                                                        aria-hidden="true"></i></a>--
                            <a href="#"><i style="font-size: 35px;" class="fa fa-linkedin" aria-hidden="true"></i></a>--
                        </ul>
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
        </div>
    </div>
</footer>
<script src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
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
    $("#myModal").modal({"backdrop": "static"});
</script>
</body>

</html>