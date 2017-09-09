@extends('admin.layout.admin')
@section('content')
    @if(Session::has('success-adding'))
     <div class="alert alert-success">
         <p>@lang('module.admin.success-adding')</p>
     </div>
    @endif
    {{ csrf_field() }}
    {!! Form::open(['method' => 'GET', 'route' => ['securityQuestions.store_question']])!!}
    <br>
    {!! Form::text('question_text', old('question_text'),['class' => 'form-control', 'placeholder' => 'Enter new question...']) !!}
    <br>
    {!! Form::text('answer', old('question_answer'),['class' => 'form-control', 'placeholder' => 'Enter question answer...']) !!}
    <br>
    {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection