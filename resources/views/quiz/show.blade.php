@extends('layouts.sidebar')
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['solve.store']]) !!}

    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
    {!! Form::close() !!}
@endsection