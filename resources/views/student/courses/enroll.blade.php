@extends('layouts.sidebar')
@section('content')
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
                                    <h3 style="color:rgb(255,254,254);">{{$course->title}}</h3><span
                                            style=" color:rgb(55,55,55);font-size:14px;
                        ">{{$course->access_code}}</span>
                                </div>
                                <div class="pricingContent">
                                    <ul>
                                        <li><strong>{{$course->description}}</strong></li>
                                    </ul>
                                </div>
                                <div class="pricingTable-sign-up">
                                    <button class="btn btn-danger" id="enroll{{$course->id}}"
                                            onclick="enroll({{$course->id}})">@lang('module.courses.enroll-course')</button>
                                    <div class="form-group" id="register{{$course->id}}" name="register"
                                         style="display:none;">
                                        {{ Form::open(['method' => 'POST', 'route' => ['enroll.store', $course->id]]) }}
                                        <br>
                                        <label for="usr">Access code:</label>
                                        <br>
                                        <br>
                                        <input type="text" class="form-control" id="accessCode">
                                        <br>
                                        {{ Form::submit('enroll', ['class' => 'btn btn-info']) }}
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