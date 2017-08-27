@extends('layouts.sidebar')
@section('content')
    <button class="btn btn-xs btn-success" id="add" name="add">@lang('module.announcements.add-announcement')</button>
    <br>
    <br>
    <div id="add-announcement" style="display:none;">
        {!! Form::open(['method' => 'POST', 'route' => ['announcements.store'], 'enctype' => 'multipart/form-data'])!!}
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('module.announcements.add-announcement')
            </div>
            <div class="panel-body">
                {!! Form::label('selected_course',trans('module.quizzes.course-title'), ['class' =>'control-label']) !!}
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <select class="form-control" name="course_id" required>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->title}}</option>
                            @endforeach
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
                        {!! Form::label('title',trans('module.announcements.content'),['class' => 'control-label']) !!}
                        {!! Form::text('announcement', old('announcement'), ['required','class' => 'form-control ','placeholder' => '']) !!}
                        @if($errors->has('announcement'))
                            <p class="help-block alert-danger">
                                {{ $errors->first('announcement') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                {!! Form::submit(trans('module.save'), ['class' => 'btn btn-success' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
                {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="announcement">
        <blockquote style="border-left-color:#0D3059; background-color:gainsboro;">
            <p class="text-blue">The world is a dangerous place to live; not because of the people who are evil, but
                because
                of the people who don't do anything about it.</p>
            <small><cite>Dr/Ghada</cite></small>
        </blockquote>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $("button").click(function () {
                $("#add-announcement").toggle(800);
            });
        });
    </script>
@endsection