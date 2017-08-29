@include('layouts.css')
        <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-push-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong style="font-family: Arial">JavaScript Required</strong>
                    <hr>
                    <div class="form-group">
                    <p>We're sorry, but FCI-H-LMS doesn't work properly without JavaScript enabled.</p>
                    <a class="btn btn-blue" role="button" href="{{ route('home') }}">Reload
                        Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>