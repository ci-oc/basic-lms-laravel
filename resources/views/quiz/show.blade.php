@extends('layouts.sidebar')
@section('content')
    <style>
        div.code_snippet {
            margin: 15px 0 5px 0;
            padding: 7px;
            font-family: "Courier New";
            border: 1px dashed #CCC;
            background-color: #F7F7F7;
            white-space: pre;
        }
    </style>
    <h3 class="page-title">@lang('module.quizzes.solve')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['solve.store']]) !!}
    <div class="panel panel-default">
        <?php $i = 1;?>
        @if ( count($questions) > 0)
            @foreach($questions as $question)
                @if(count($question) > 0)
                    @if($question->quiz_id == $id)
                        @if ($i == 1)
                                <div class="panel-heading">
                                    {{$question->quiz->course->title}} - {{ $question->quiz->title }}
                                </div>
                        @endif
                        @if ($i > 1)
                            <hr/>
                        @endif
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-12 form-group">
                                <div class="col-sm-8">
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
                                        <input
                                                type="radio"
                                                name="answers[{{ $question->id }}]"
                                                value="{{ $option->id }}">
                                        {{ $option->option }}
                                    @endforeach
                                </div>
                                <div class="col-sm-4">
                                    <strong>{!! nl2br($question->grade) !!} @lang('module.questions-options.fields.grade')</strong>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                    @endif
                @endif
            @endforeach
        @endif
        @if ( count($problems) > 0)
            @foreach($problems as $problem)
                @if(count($problem) > 0)
                    @if($problem->quiz_id == $id)
                        @if ($i > 1)
                            <hr/>
                        @endif
                        <div class="row" style="margin-top: 10px">
                            <div class="col-xs-12 form-group">
                                <div class="col-sm-8">
                                    <strong>@lang('module.questions.name') {{ $i }}
                                        .<br/>{!! nl2br($problem->question_text) !!}</strong>
                                    @if ($problem->code_snippet != '')
                                        <div class="code_snippet">{!! $problem->code_snippet !!}</div>
                                    @endif
                                    <input
                                            type="hidden"
                                            name="questions[{{ $i }}]"
                                            value="{{ $problem->id }}">
                                    <?php $count = 1?>
                                    <strong>@lang('module.problems.fields.input_format')
                                        .<br/>{!! nl2br($problem->input_format) !!}</strong>
                                    <hr>
                                    <strong>@lang('module.problems.fields.output_format')
                                        .<br/>{!! nl2br($problem->output_format) !!}</strong>
                                    <hr>
                                    @foreach($problem->testcases as $testcase)
                                        @if($count > 2)
                                            @break
                                        @endif
                                        <br>
                                        <label class="radio-inline">@lang('module.problems.example-input')</label>
                                        <div class="code_snippet">{!! $testcase->input !!}</div>
                                        <label class="radio-inline">@lang('module.problems.example-output')</label>
                                        <div class="code_snippet">{!! $testcase->output !!}</div>
                                        <hr>
                                        <?php $count++;?>
                                    @endforeach
                                    {!! Form::label('user_code',Lang::get('module.problems.code'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('user_code', old('user_code'), ['class' => 'form-control ','style' => 'resize:none;']) !!}
                                </div>
                                <div class="col-sm-4">
                                    <strong>{!! nl2br($problem->grade) !!} @lang('module.questions-options.fields.grade')</strong>
                                </div>
                            </div>
                            <?php $i++; ?>
                        </div>
                    @endif
                @endif
            @endforeach
        @endif
    </div>

    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
    {!! Form::close() !!}
@endsection