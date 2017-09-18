@extends('layouts.sidebar')
@section('css')
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
@endsection
@section('content')
    <?php $i = 1;?>
    @if($return_duration != null)
        <div class="row">
            <div class="col-xs-12 form-group">
                <div class="col-sm-8">
                    <iframe src="http://free.timeanddate.com/countdown/i5vpnmoi/n53/cf12/cm0/cu4/ct0/cs1/ca0/co1/cr0/ss0/cac000/cpc000/pct/tcf1d8e7/fs100/szw448/szh189/tac000/tpc000/iso{{$return_duration}}"
                            allowTransparency="true" frameborder="0" width="128" height="36"></iframe>
                </div>
                <div class="col-sm-4 text-red">
                    @lang('module.quizzes.caution')
                </div>
            </div>
        </div>
    @endif
    {!! Form::open(['method' => 'POST', 'route' => ['solve.store']]) !!}
    {{ csrf_field() }}
    <div class="panel panel-default">
        {{ Form::hidden('quiz_id', encrypt($id), array('id' => 'quiz_id')) }}
        <div class="panel-heading">
            {{$quiz->course->title}} - {{ $quiz->title }}
        </div>
        @if($quiz->duration != null)
        <!--BEGIN TIME THEME-->
            <div id="theme-setting">
                <a href="#" data-toggle="dropdown" data-step="1"
                   data-intro="&lt;b&gt;Many styles&lt;/b&gt; and &lt;b&gt;colors&lt;/b&gt; be created for you. Let choose one and enjoy it!"
                   data-position="left" class="btn-theme-setting"><i class="fa fa-clock-o"
                                                                     aria-hidden="true"></i></a>
                <div class="content-theme-setting">
                    <div class="form-group">
                        <strong>
                            <iframe src="http://free.timeanddate.com/countdown/i5vpnmoi/n53/cf12/cm0/cu4/ct0/cs1/ca0/co1/cr0/ss0/cac000/cpc000/pct/tcf1d8e7/fs100/szw448/szh189/tac000/tpc000/iso{{$return_duration}}"
                                    allowTransparency="true" frameborder="0" width="128" height="36"></iframe>
                        </strong>
                    </div>
                </div>
            </div>
        @endif
        {{--END TIME THEME--}}
        @if ( count($quiz_questions) > 0)
            @foreach($quiz_questions as $question)
                @if(count($question) > 0)
                    @if ($i > 1)
                        <hr/>
                    @endif
                    <div class="row" style="margin-top: 10px">
                        <div class="col-xs-12 form-group">
                            <div class="col-sm-8">
                                <strong>Question {{ $i }}.<br/>{!! nl2br($question->question_text) !!}</strong>
                                @if ($question->code_snippet != '')
                                    <div class="code_snippet">{{ $question->code_snippet }}</div>
                                @endif
                                <hr>
                                <input
                                        type="hidden"
                                        name="questions[{{ $i }}]"
                                        value="{{ $question->id }}">
                                @foreach($question->options as $option)
                                    <input
                                            type="radio"
                                            name="answers[{{ $question->id }}]"
                                            value="{{ $option->id }}">
                                    {{ $option->option }}
                                    <br>
                                @endforeach
                            </div>
                            <div class="col-sm-4">
                                <strong>{!! nl2br($question->grade) !!} @lang('module.questions-options.fields.grade')</strong>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                @endif
            @endforeach
        @endif
        @if ( count($quiz_problems) > 0)
            @foreach($quiz_problems as $problem)
                @if(count($problem) > 0)
                    @if ($i > 1)
                        <hr/>
                    @endif
                    <div class="row" style="margin-top: 10px">
                        <div class="col-xs-12 form-group">
                            <div class="col-sm-8">
                                <strong>@lang('module.questions.name') {{ $i }}
                                    .<br/>{!! nl2br($problem->question_text) !!}</strong>
                                @if ($problem->code_snippet != '')
                                    <div class="code_snippet">{{ $problem->code_snippet }}</div>
                                @endif
                                <hr>
                                <input
                                        type="hidden"
                                        name="problems[{{ $i }}]"
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
                                    <label class="radio-inline">@lang('module.problems.example-input')</label>
                                    <div class="code_snippet">{!! $testcase->input !!}</div>
                                    <label class="radio-inline">@lang('module.problems.example-output')</label>
                                    <div class="code_snippet">{!! $testcase->output !!}</div>
                                    <hr>
                                    <?php $count++;?>
                                @endforeach
                                <select class="selectpicker" name="code_language[{{$problem->id}}]" required>
                                    @foreach($problem->coding_languages as $lang)
                                        <option value="{{$lang->compile_name}}">{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <br>
                                {!! Form::label('user_code',trans('module.problems.code'), ['class' => 'control-label']) !!}
                                {{ Form::textarea('user_code['.$problem->id .']', old('user_code'), ['class' => 'form-control ','style' => 'resize:none;','id' => 'user_code']) }}
                            </div>
                            <div class="col-sm-4">
                                <strong>{!! nl2br($problem->grade) !!} @lang('module.questions-options.fields.grade')</strong>
                                <div class="form-group">
                                    <p>Judging Options:</p>
                                    @foreach($problem->judge_options as $judge_option)
                                        <li class="alert alert-info"> @lang('module.judge_options.options.' . $judge_option->description)</li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
    {!! Form::close() !!}

@endsection
@section('javascript')
    @if($quiz['duration'] != null)
        <script>
            $('#user_code').bind("cut copy paste",function(e) {
                e.preventDefault();
            });
        </script>
    @endif
    <script>
        //BEGIN THEME SETTING
        $('#theme-setting > a.btn-theme-setting').click(function () {
            if ($('#theme-setting').css('right') < '0') {
                $('#theme-setting').css('right', '0');
            } else {
                $('#theme-setting').css('right', '-250px');
            }
        });
    </script>
@endsection