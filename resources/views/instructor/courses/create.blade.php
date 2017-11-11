@extends('layouts.sidebar')
@section('content')
    @if(Session::has('material-name-error'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-material-name')</p>
        </div>
    @endif
    @if(Session::has('failed_instructors'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-create-user')</p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('module.placeholders.email')</th>
                </tr>
                </thead>
                <tbody>
                @foreach(Session::get('failed_instructors') as $user)
                    <tr>
                        <td>{{ $user }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @elseif(Session::has('failed_to_save'))
        <div class="alert alert-danger">
            <p>{{Session::get('failed_to_save')}}</p>
        </div>
    @endif
    @if(Session::has('error-access-code'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-access-code')</p>
        </div>
    @endif
    @if(Session::has('error-course-title'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-course-title')</p>
        </div>
    @endif
    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
    </div>
    <h3 class="page-title">@lang('module.courses.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['courses.store'], 'enctype' => 'multipart/form-data'])!!}
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('access-code', trans('module.courses.fields.access_code'), ['class' => 'control-label']) !!}
                    {!! Form::text('access_code', old('access_code'), ['required','class' => 'form-control ','id' => 'access_code']) !!}
                    @if($errors->has('access_code'))
                        <p class="help-block alert-danger" data-value="shake">
                            {{ $errors->first('access_code') }}

                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('course-title', trans('module.courses.fields.course'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['required','class' => 'form-control ', 'placeholder' => '']) !!}
                    @if($errors->has('title'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('assistant-professor', trans('module.courses.fields.assistant_professor'), ['class' => 'control-label']) !!}
                    {!! Form::text('assistant_professor', old('assistant_professor'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    @if($errors->has('assistant_professor'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('assistant_professor') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('desc', trans('module.courses.fields.desc'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['required','class' => 'form-control ', 'placeholder' => '','style' => 'resize:none;']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('course_material', trans('module.courses.fields.material-1'), ['class' => 'control-label']) !!}
                {!! Form::file('material[]', ['multiple' => 'multiple' ,'class' => 'form-control']) !!}
                @if($errors->has('material.*'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('material.*') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#access_code').bind("cut copy paste", function (e) {
                e.preventDefault();
            });
        });
    </script>
@endsection