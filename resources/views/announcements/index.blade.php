@extends('layouts.sidebar')
@section('content')

    @if(Session::has('success'))
        <div class="alert alert-info">
            <p>@lang('module.announcements.success')</p>
        </div>
    @elseif(Session::has('delete'))
        <div class="alert alert-danger">
            <p>@lang('module.announcements.deleted')</p>
        </div>
    @elseif(Session::has('failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-saving-data')</p>
        </div>
    @endif
    @if(Auth::user()->can('add-announcement'))
        <button class="btn btn-success" id="add"
                name="add">@lang('module.announcements.add-announcement')</button>
        <br>
        <br>
    @endif
    <div id="add-announcement" style="display:none;">
        {!! Form::open(['method' => 'POST', 'route' => ['announcements.store'], 'enctype' => 'multipart/form-data'])!!}
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('module.announcements.add-announcement')
            </div>
            <div class="panel-body">
                @if(count($courses) == 0)
                    {{trans('module.courses.fields.no_courses')}}
                @else
                    {!! Form::label('selected_course',trans('module.quizzes.course-title'), ['class' =>'control-label']) !!}
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <select class="form-control" name="ID" required>
                                @foreach($courses as $course)
                                    <option value="{{encrypt($course->id)}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('ID'))
                                <p class="help-block alert-danger">
                                    {{ $errors->first('ID') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            {!! Form::label('title',trans('module.announcements.content'),['class' => 'control-label']) !!}
                            {!! Form::textarea('announcement', old('announcement'), ['required','class' => 'form-control ','placeholder' => '']) !!}
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
                @endif
            </div>
        </div>
    </div>
    @if(count($announcements) > 0)
        @foreach($announcements as $announcement_data)
            @if(count($announcement_data) > 0)
                @foreach($announcement_data as $announcement)
                    <div class="announcement">
                        <blockquote style="border-left-color:#0D3059; background-color:gainsboro;">
                            <p>{{ $announcement->course->title }}</p>
                            <p class="text-facebook">{{ $announcement->announcement }}</p>
                            <small>
                                <cite>{{  Auth::id() == $announcement->user_id ? trans('module.you')  : $announcement->user->name}}</cite>
                            </small>
                        </blockquote>
                        @if(Auth::id() == $announcement->user_id)
                            {{ Form::open(['method' => 'DELETE', 'route' => ['announcements.destroy', $announcement->id]]) }}
                            {{ Form::submit('DELETE', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        @endif
                    </div>
                    <hr>
                @endforeach
            @endif
        @endforeach
    @else
        <h1>{{trans('module.announcements.no_announcements_yet')}}</h1>
    @endif
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $("button").click(function () {
                $("#add-announcement").toggle(300);
            });
        });
    </script>
@endsection