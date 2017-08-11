        <!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Features-Clean.css') }}" rel="stylesheet">
    <link href="{{ asset('css/team-box.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

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
            border-radius: 25px;
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
            background-color: #56c6c6;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            transition: 0.5s;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="jumbotron hero"
             style="background-image:url({{ URL::asset('images/background.jpg') }});height:640px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-push-7 phone-preview">
                        <div class="iphone-mockup"></div>
                    </div>
                    <div class="col-md-8 col-md-pull-5 get-it">
                        <h1>FCI-H Online Judge</h1>
                        <p>Easy Communication between Instructors and Students</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="testimonials">
            <h2 id="avalaible_features" class="text-center">Students will Love It!</h2>
            <blockquote>
                <p>Let's take a quick tour to know the Project Featuers, It may be very amazing !</p>
            </blockquote>
        </section>
        <section class="features" style="background-color:#181818;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Fantastic Online Judge</h2>
                        <p>The first phase is to create a smart Online Judge which you can use it to compile your
                            assginment problems and compare it with some test cases and get the result of your code. Our
                            Judge has some knowledge about your code efficiency
                            and its complexity. Your code output may be correct but it also may be refused, so be
                            careful ;)</p>
                    </div>
                    <div class="col-md-6">
                        <div class="row icon-features">
                            <div class="col-xs-4 icon-feature"><i class="fa fa-code"
                                                                  style="width:60px;height:60px;font-size:60px;margin-bottom:5px;"></i>
                                <p>Several progrramming languages</p>
                            </div>
                            <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-floppy-save"></i>
                                <p>Memory complexity</p>
                            </div>
                            <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-hourglass"></i>
                                <p>Time complexity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="features-clean">
            <div class="container">
                <div class="intro">
                    <h2 id="coming_soon" class="text-center">Coming Soon ...</h2>
                    <p class="text-center">This Features are under development now and it will be delivered in next
                        phases. We need your support :)</p>
                </div>
                <div class="row features">
                    <div class="col-md-4 col-sm-6 item"><i class="fa fa-quora icon"></i>
                        <h3 class="name">Make and solve Quizzes</h3>
                        <p class="description">The System provides a way for making and solving two types of quizzes
                            (MCQ questions &amp; Coding Problems).</p>
                    </div>
                    <div class="col-md-4 col-sm-6 item"><i class="glyphicon glyphicon-plane icon"></i>
                        <h3 class="name">Very fast marking</h3>
                        <p class="description">Professors just provide us with a pdf file contains student's name &amp;
                            id, then every student will get his grades automatically.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 item"><i class="glyphicon glyphicon-stats icon"></i>
                        <h3 class="name">Statistics and Rating</h3>
                        <p class="description">The System provides rating for every studen, Course, and Faculty. It can
                            generate useful defferent statistics </p>
                    </div>
                    <div class="col-md-4 col-sm-6 item"><i class="glyphicon glyphicon-leaf icon"></i>
                        <h3 class="name">Msh 3arf aktb feha eh :D</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                            Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 item"><i class="fa fa-share icon"></i>
                        <h3 class="name">Get your Feedback!</h3>
                        <p class="description">Our System will till you about your weak points according to your
                            mistakes in the Quizzes.</p>
                    </div>
                    <div class="col-md-4 col-sm-6 item"><i class="glyphicon glyphicon-phone icon"></i>
                        <h3 class="name">Mobile-friendly (avalaible now)</h3>
                        <p class="description">Responsive Designs for any devices like large computers, laptops, ipads,
                            and mobile phones.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="team-boxed">
            <div class="container">
                <div class="intro">
                    <h2 id="team" class="text-center">Team </h2>
                    <p class="text-center">We are all your mates in FCI-H, in level 3, and this is our porject in
                        Software Engineering Course unde the supervision of Prof. Ghada Khoriba.</p>
                </div>
                <div class="row people">
                    <div class="col-md-3 col-sm-6 item">
                        <div class="box"><img class="img-circle" src="{{ URL::asset('images/developers/andrew.jpg') }}">
                            <h3 class="name">Andrew Amir</h3>
                            <p class="title">Developer </p>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                                Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo
                                suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                            <div class="social"><a target="blank" href="https://www.facebook.com/Anagyeb"><i
                                            class="fa fa-facebook-official"></i></a><a target="blank" href="#"><i
                                            class="fa fa-twitter"></i></a><a target="blank"
                                                                             href="https://www.instagram.com/drew0_9/"><i
                                            class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 item">
                        <div class="box"><img class="img-circle" src="{{ URL::asset('images/developers/eyad.jpg') }}">
                            <h3 class="name">Eyad Shokry</h3>
                            <p class="title">Developer </p>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                                Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo
                                suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                            <div class="social"><a target="blank" href="https://www.facebook.com/EyadMShokry"><i
                                            class="fa fa-facebook-official"></i></a><a target="blank" href="#"><i
                                            class="fa fa-twitter"></i></a><a target="blank"
                                                                             href="https://www.instagram.com/eyad_muhammed/"><i
                                            class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 item">
                        <div class="box"><img class="img-circle" src="{{ URL::asset('images/developers/mina.jpg') }}">
                            <h3 class="name">Mina Mofreh</h3>
                            <p class="title">Developer </p>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                                Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo
                                suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                            <div class="social"><a target="blank" href="https://www.facebook.com/mina.mefreh.5"><i
                                            class="fa fa-facebook-official"></i></a><a target="blank" href="#"><i
                                            class="fa fa-twitter"></i></a><a target="blank"
                                                                             href="https://www.instagram.com/mina__mofreh/"><i
                                            class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-0 col-sm-6 item" style="height:600px;">
                        <div class="box"><img class="img-circle" src="{{ URL::asset('images/developers/yassen.jpg') }}">
                            <h3 class="name">Yassen Mehrez</h3>
                            <p class="title">developer </p>
                            <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus.
                                Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo
                                suscipit id. Etiam dictum feugiat tellus, a semper massa.&nbsp; </p>
                            <div class="social"><a target="blank" href="https://www.facebook.com/yassen.mehrez"><i
                                            class="fa fa-facebook-official"></i></a><a target="blank" href="#"><i
                                            class="fa fa-twitter"></i></a><a target="blank"
                                                                             href="https://www.instagram.com/yassen_mehrez/"><i
                                            class="fa fa-instagram"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

