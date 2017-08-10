@extends('layouts.sidebar')
@section('content')
    <h3>{{ Auth::user()->name }}</h3>
    <h3 class="page-title">@lang('module.quiz-title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}
    {!! Form::submit(trans('module.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection