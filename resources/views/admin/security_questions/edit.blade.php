@extends('admin.layout.admin')
@section('content')
    @if(Session::has('success-editing'))
        <div class="alert alert-success">
            <p>@lang('module.success.success-editing-question')</p>
        </div>
    @endif
    {!! Form::open(['method' => 'PUT', 'route' => ['securityQuestions.update',$question[0]['id']], 'enctype' => 'multipart/form-data'])!!}
    {{ csrf_field() }}
    {!! Form::text('question_text', $question[0]['question_text'],['class' => 'form-control', 'placeholder' => $question[0]['question_text']]) !!}
    <br>
    {!! Form::text('answer', $question[0]['answer'], ['class' => 'form-control', 'placeholder' => $question[0]['answer']]) !!}
    <br>
    {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection