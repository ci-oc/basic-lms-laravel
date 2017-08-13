@extends('layouts.sidebar')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet">
    <h3 class="page-title">@lang('module.quizzes.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' =>['quizzes.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('selected_course',Lang::get('module.quizzes.course-title'), ['class' =>'control-label']) !!}
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
                    {!! Form::label('title',Lang::get('module.quizzes.fields.quiz'),['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['required','class' => 'form-control ','placeholder' => '']) !!}
                    @if($errors->has('title'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description',Lang::get('module.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['required','class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration',Lang::get('module.quizzes.fields.duration'), ['class' => 'control-label']) !!}
                    {!! Form::text('duration', old('duration'), ['required','class' => 'timepicker form-control ','placeholder' => '','type' => 'text']) !!}
                    @if($errors->has('duration'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                </div>
            </div>
            {!! Form::label('start_date',Lang::get('module.quizzes.fields.start-date'), ['class' => 'control-label']) !!}
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::date('start_date', old('start_date'), ['required','class' => 'form-control ','id' => 'start_date']) !!}

                    @if($errors->has('start_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::time('start_time', old('start_time'), ['required','class' => 'form-control ','id' => 'start_time']) !!}

                    @if($errors->has('start_time'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('start_time') }}
                        </p>
                    @endif
                </div>
                <br>
                <br>

                <div class="col-xs-12">
                    {!! Form::hidden('start_date_time', old('start_date_time'), ['id' => 'hidden_input_start']) !!}
                </div>
            </div>
            {!! Form::label('end_date',Lang::get('module.quizzes.fields.end-date'), ['class' => 'control-label']) !!}
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::date('end_date', old('end_date'), ['required','class' => 'form-control ','id' => 'end_date']) !!}

                    @if($errors->has('end_date'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::time('end_time', old('end_time'), ['required','class' => 'form-control ','id' => 'end_time']) !!}
                    @if($errors->has('end_time'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('end_time') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12">
                    {!! Form::hidden('end_date_time', old('end_date_time'), ['required','id' => 'hidden_input_end']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('full_mark', Lang::get('module.quizzes.fields.full-mark'), ['class' => 'control-label']) !!}
                    {!! Form::input('number','full_mark', old('grade'), ['required','class' => 'form-control ', 'placeholder' => '','step' => '0.5']) !!}
                    @if($errors->has('full_mark'))
                        <p class="help-block">
                            {{ $errors->first('full_mark') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary' ,'data-value' => 'shake']) }}
    {!! Form::close() !!}
@endsection
@section('javascript')
    <script type="text/javascript">
        function assign_date() {
            var start_date = document.getElementById('start_date').value;
            var start_time = document.getElementById('start_time').value;

            var end_date = document.getElementById('end_date').value;
            var end_time = document.getElementById('end_time').value;

            var start_date_time = start_date + " " + start_time;
            var end_date_time = end_date + " " + end_time;

            document.getElementById('hidden_input_start').value = start_date_time;
            document.getElementById('hidden_input_end').value = end_date_time;
        }
    </script>
@endsection