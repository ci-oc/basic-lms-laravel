@extends('admin.layout.admin')
@section('content')
    {{ csrf_field() }}
    {!! Form::open(['method' => 'PUT', 'route' => ['securityQuestions.store_question']])!!}
    <br>
    {!! Form::text('question_text', old('question_text'),['class' => 'form-control', 'placeholder' => 'Enter new question...']) !!}
    <br>
    {!! Form::text('answer', old('question_text'),['class' => 'form-control', 'placeholder' => 'Enter new question...']) !!}
    <br>
    {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection