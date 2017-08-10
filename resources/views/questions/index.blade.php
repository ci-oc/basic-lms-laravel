@extends('layouts.sidebar')
@section('content')
    <a href="{{route('questions.create')}}" class="btn bg-primary create_btn">
        Add New
    </a>
@endsection