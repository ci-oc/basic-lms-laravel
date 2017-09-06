<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('welcome/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display">
    <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Rajdhani" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mallanna" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('welcome/fonts/font-awesome.min.css')}}">

    <title>Security Area</title>
</head>
<body>
@if(Session::has('failed-questions'))
<div class="alert alert-danger">
    <p>@lang('module.errors.error-questions-errors')</p>
</div>
@endif
<div class="jumbotron" style="text-align: center; background-color: #7da8c3;">
    <h1>@lang('module.admin.security-questions')</h1>
    <p>@lang('module.admin.caption')</p>
    <span>FCIH-Module</span>
</div>

<div class="panel panel-default">
    <div class="panel-heading">@lang('module.admin.security-questions')</div>
    <div class="panel-body">
        {!! Form::open(['method' => 'POST', 'route' => ['securityQuestions.store'], 'enctype' => 'multipart/form-data'])!!}
        @foreach($security_questions as $question)
            <div class="col-xs-12 form-group">
                <p style="margin: auto;">{{$question['question_text']}}</p>
                {!! Form::text('question'.$question['id'], old('answer'), ['class' => 'form-control','required', 'placeholder' => Lang::get('module.admin.answer')]) !!}
                @if($errors->has('answer-failed'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('answer-failed') }}
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <div class="panel-footer">
        {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
        {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
        {!! Form::close() !!}

    </div>
</div>
</body>
<script src="{{asset('welcome/js/bootstrap.min.js')}}"></script>
<script src="{{asset('welcome/js/jquery.min.js')}}"></script>

</html>