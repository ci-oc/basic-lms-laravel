@extends('layouts.sidebar')
@section('content')
    <h3 class="page-title">@lang('module.quizzes.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' =>['quizzes.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('selected_course',Lang::get('module.quizzes.course-title'), ['class' =>'control-label']) !!}
                    {!! Form::select('course_id', $courses, old('course_id'), ['class' => 'form-control']) !!}
                    @if($errors->has('selected_course'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('selected_course') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title',Lang::get('module.quizzes.fields.quiz'),['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control ','placeholder' => '']) !!}
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
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration',Lang::get('module.quizzes.fields.duration'), ['class' => 'control-label']) !!}
                    {!! Form::text('duration', old('duration'), ['class' => 'form-control ','placeholder' => '']) !!}
                    @if($errors->has('duration'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_date',Lang::get('module.quizzes.fields.start-date'), ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control ','placeholder' => '']) !!}
                    @if($errors->has('start_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end_date',Lang::get('module.quizzes.fields.end-date'), ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control ','placeholder' => '']) !!}
                    @if($errors->has('end_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('full_mark', Lang::get('module.quizzes.fields.full-mark'), ['class' => 'control-label']) !!}
                    {!! Form::input('number','full_mark', old('grade'), ['class' => 'form-control ', 'placeholder' => '','step' => '0.5']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('full_mark'))
                        <p class="help-block">
                            {{ $errors->first('full_mark') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection