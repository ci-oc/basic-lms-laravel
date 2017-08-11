<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>
<style>
    body, html {
        height: 100%;
        margin: 0;
        overflow-y: hidden;
    / / hide vertical overflow-x: hidden;
    / / hide horizontal
    }

    .jumbotron {
        /* The image used */
        background-image: url({{ URL::asset('images/errors/404.jpg') }});

        /* Full height */
        height: 100%;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .jumbotron h1 , h4{
        color: #e9daff;
        text-shadow: 4px 4px #002e4d;
    }
</style>
<body>
<div class="jumbotron hero">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-xs-offset-2">
                <h1>FCI-H Module</h1>
                <h4>You can return home by clicking the button below.</h4>
                <a href="{{route('home')}}" class="btn btn-primary btn-sm" role="button">Return!</a>
            </div>
        </div>
    </div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>