@extends('layouts.sidebar')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet">
@endsection
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{!! Session::get('success') !!}</div>
    @endif
    @if (Session::has('failure'))
        <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
    @endif

    {!! Form::open(['method' => 'PUT', 'route' => ['quizzes.update', $id]])!!}
    <input type="hidden" name="id" value="{{$id}}">
    <h3 class="page-title">@lang('module.edit'): {{ $quiz->title }}</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.edit')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title',trans('module.quizzes.fields.quiz'),['class' => 'control-label']) !!}
                    {!! Form::text('title', $quiz->title , ['class' => 'form-control ','required']) !!}
                    @if($errors->has('title'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description',Lang::get('module.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', $quiz->description , ['class' => 'form-control ','resize' => 'none','rows' => '6', 'placeholder' => $quiz->description, 'required']) !!}
                    @if($errors->has('description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {{ Form::checkbox('solve_many',null,null, ['class' => 'field','id' => 'solve_many']) }}
                    {!! Form::label('solve_many',trans('module.judge_options.quiz-options.solve_many'), ['class' => 'control-label']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration',trans('module.quizzes.fields.duration'), ['class' => 'control-label']) !!}
                    <div class='input-group time timepicker'>
                        {!! Form::text('duration', $quiz->duration , ['class' => 'form-control ','placeholder' => $quiz->duration,'type' => 'text']) !!}
                        <span class="input-group-addon" style="cursor: pointer;" readonly="true">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </span>
                        @if($errors->has('duration'))
                            <p class="help-block alert-danger">
                                {{ $errors->first('duration') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            {!! Form::label('start_date',trans('module.quizzes.fields.start-date'), ['class' => 'control-label']) !!}
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class='input-group date' id='datetimepicker3'>
                        {!! Form::input('text','start_date', $quiz->start_date , ['class' => 'form-control ', 'placeholder' => $quiz->start_date,'type' => 'text','required']) !!}
                        <span class="input-group-addon">
           					<i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>
                    @if($errors->has('start_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::label('end_date',trans('module.quizzes.fields.end-date'), ['class' => 'control-label']) !!}
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class='input-group date' id='datetimepicker4'>
                        {!! Form::input('text','end_date', $quiz->end_date, ['class' => 'form-control ', 'placeholder' => $quiz->end_date,'type' => 'text','required']) !!}
                        <span class="input-group-addon">
                             <i class="fa fa-calendar" aria-hidden="true"></i>
                        </span>
                    </div>

                    @if($errors->has('end_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('javascript')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">

        $('.timepicker').datetimepicker({

            format: 'HH:mm:ss'

        });

    </script>
    <script type="text/javascript">
        var dateToday = new Date();
        var lastDate = new Date(dateToday.getFullYear() + 20, 11, 31);

        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                minDate: dateToday,
                maxDate: lastDate,
            });
        });
        $(function () {
            $('#datetimepicker4').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                minDate: dateToday,
                maxDate: lastDate,
            });
        });
    </script>
@endsection