@extends('layouts.app')
@section('content')
    <h3>{{ Auth::user()->name }}</h3>
    <h3 class="page-title">@lang('module.quiz-title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.quiz')
        </div>
        @if(count($questions) > 0)
            <div class="panel-body">
                <?php $i = 1; ?>
                @foreach($questions as $question)
                    @if ($i > 1)
                        <hr/> @endif
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="form-group">
                                <strong>Question {{ $i }}.<br/>{!! nl2br($question->question_text) !!}</strong>

                                @if ($question->code_snippet != '')
                                    <div class="code_snippet">{!! $question->code_snippet !!}</div>
                                @endif

                                <input
                                        type="hidden"
                                        name="questions[{{ $i }}]"
                                        value="{{ $question->id }}">
                                @foreach($question->options as $option)
                                    <br>
                                    <label class="radio-inline">
                                        <input
                                                type="radio"
                                                name="answers[{{ $question->id }}]"
                                                value="{{ $option->id }}">
                                        {{ $option->option }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endforeach
            </div>
            {!! Form::submit(trans('module.submit_quiz'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        @endif
    </div>

@endsection