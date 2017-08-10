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
                    {!! Form::label('selected_course',Lang::get('module.problems.fields.selected_quiz'), ['class' =>'control-label']) !!}
                    <select class="form-control">
                        <option>5ra</option>
                        <option>nela</option>
                    </select>
                    @if($errors->has('selected_course'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('selected_course') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('quiz_name',Lang::get('module.quizzes.fields.quiz'),['class' => 'control-label']) !!}
                    {!! Form::text('quiz_name', old('quiz_name'), ['class' => 'form-control ','placeholder' => 'Type Quiz Name']) !!}
                    @if($errors->has('quiz_name'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('quiz_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Description',Lang::get('module.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
@endsection