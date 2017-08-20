@extends('layouts.sidebar')
@section('css')
    <style>
        .description{
            overflow: hidden;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            display: -webkit-box;
        }
    </style>
@endsection
@section('content')
    @if(Session::has('invalid_access_code'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-access-code')</p>
        </div>
    @endif
    <link href="{{ asset('css/instructor/instructor_homa_page_style.css') }}" rel="stylesheet">
    @if( count($available_courses ) > 0)
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
                <div class="row">
                    @foreach($available_courses as $course)
                        <div class="col-md-4 col-sm-4" style="margin-top: 10px;">
                            <div class="pricingTable">
                                <div class="pricingTable-header"
                                     style="background-color:{{$colors[random_int(0,3)]}};">
                                    <h3 style="color:rgb(255,254,254);">{{$course->title}}</h3>
                                </div>
                                <div class="pricingContent">
                                    <ul>
                                        <li class="description"><strong>{{$course->description}}</strong></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="pricingTable-sign-up">
                                    <button class="btn btn-danger" id="enroll{{$course->id}}"
                                            onclick="enroll({{$course->id}})">@lang('module.courses.enroll-course')</button>
                                    <div class="form-group" id="register{{$course->id}}" name="register"
                                         style="display:none;">
                                        {{ Form::open(['method' => 'POST', 'route' => 'enroll.store']) }}
                                        <br>
                                        <label for="usr">Access code:</label>
                                        <br>
                                        <br>
                                        {{ Form::hidden('course_id', $course->id, array('id' => 'course_id')) }}
                                        <input type="text" class="form-control" id="accessCode" name="access_code">
                                        <br>
                                        {{ Form::submit(Lang::get('module.save'), ['class' => 'btn btn-info']) }}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <h1 class="display-1">@lang('module.no_entries_in_table')</h1>
    @endif

@endsection

@section('javascript')
    <script>
        function enroll(id) {
            $("#register" + id).toggle(500);
        }
    </script>
@endsection