@extends('layouts.sidebar')
@section('content')
    @if(Auth::user()->isInstructor())
        <link href="{{ asset('css/instructor/instructor_homa_page_style.css') }}" rel="stylesheet">

        <a href="{{route('courses.create')}}" class="btn bg-primary create_btn">
            Add New
        </a>
        <br>
        <br>
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-md-4 col-sm-4" style="margin-top: 10px;">
                            <div class="pricingTable">
                                <div class="pricingTable-header" style="background-color:rgb(182,150,233);">
                                    <h3 style="color:rgb(255,254,254);">{{$course->title}}</h3><span
                                            style=" color:rgb(55,55,55);font-size:14px;
                        ">{{$course->access_code}}</span>
                                </div>
                                <div class="pricingContent">
                                    <ul>
                                        <li><strong>{{$course->description}}</strong></li>
                                        <li style="background-color:rgb(239,239,237);"><a href="index.html">quiz 2</a>
                                        </li>
                                        <li><a href="index.html">quiz 3</a></li>
                                        <li style="background-color:rgb(239,239,237);"><a href="index.html">quiz 4</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pricingTable-sign-up">
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course->id]]) }}
                                    {{ Form::submit('DROP', ['class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
    @endif
@endsection