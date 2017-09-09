@extends('layouts.sidebar')
@section('content')
    @if(Session::has('failed-questions'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-questions-errors')</p>
        </div>
    @endif
    @if(session()->has('answered-correctly'))
        <div class="alert alert-info">
            <a href="{{route('admin.index',$valid_url)}}">@lang('module.admin.success-solving-questions')</a>
        </div>
    @else
        <p class="text-red">@lang('module.admin.answer-note')</p>
        <div class="panel panel-default">
            <div class="panel-heading">@lang('module.admin.security-questions')</div>
            <div class="panel-body">
                {!! Form::open(['method' => 'POST', 'route' => ['securityQuestions.store'], 'enctype' => 'multipart/form-data'])!!}
                @foreach($security_questions as $question)
                    <div class="col-xs-12 form-group">
                        <p style="margin: auto;">{{$question['question_text']}}</p>
                        {!! Form::text('question'.$question['id'], old('answer'), ['class' => 'form-control','required', 'placeholder' => Lang::get('module.admin.answer')]) !!}
                        @if($errors->has('answer-failed'))
                            <p class="help-block alert-danger">
                                {{ $errors->first('answer-failed') }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="panel-footer">
                {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger' ,'data-value' => 'shake', 'onclick' => 'shake()']) !!}
                {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}

            </div>
        </div>
    @endif
@endsection