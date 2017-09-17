@extends('layouts.sidebar')
@section('content')
    @if(Session::has('grade-failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-grade-problem')</p>
        </div>
    @endif
    @if(Session::has('full-mark-failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-full-mark-problem')</p>
        </div>
    @endif
    @if(Session::has('failed'))
        <div class="alert alert-danger">
            <p>{{Session::get('failed')}}</p>
        </div>
    @endif
    <h3 class="page-title">@lang('module.problems.new_problem')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['problems.store']]) !!}
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ID',trans('module.problems.fields.selected_quiz'), ['class' => 'control-label']) !!}
                    <select class="form-control" name="ID">
                        @foreach($quizzes as $quiz)
                            <option value="{{encrypt($quiz->id)}}">{{$quiz->course->title}} - {{$quiz->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question_text',trans('module.problems.fields.problem_desc'), ['class' => 'control-label']) !!}
                    {{ Form::textarea('question_text', old('question_text'), ['class' => 'form-control ', 'placeholder' => 'Type Problem Description','resize' => 'none']) }}
                    @if($errors->has('question_text'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('question_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('grade',trans('module.problems.fields.problem_grade'), ['class' => 'control-label']) !!}
                    {!! Form::number('grade', old('grade'), ['class' => 'form-control ', 'placeholder' => '', 'step' => '0.5']) !!}
                    @if($errors->has('grade'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('grade') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('input_format',trans('module.problems.fields.input_format'), ['class' => 'control-label']) !!}
                    {!! Form::text('input_format', old('input_format'), ['class' => 'form-control ', 'placeholder' => 'Type Input Format',]) !!}
                    @if($errors->has('input_format'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('input_format') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('output_format',Lang::get('module.problems.fields.output_format'), ['class' => 'control-label']) !!}
                    {!! Form::text('output_format', old('output_format'), ['class' => 'form-control ', 'placeholder' => 'Type Output Format',]) !!}
                    @if($errors->has('output_format'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('output_format') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('test_cases',trans('module.problems.fields.test_cases'), ['class' => 'control-label']) !!}
                    <table id="dataTable" class="table">
                        <tbody>
                        <tr>
                            <td>
                                {!! Form::label('input_testcase',trans('module.problems.fields.testCases.input_testcase'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('input_testcase[]',old('input_testcase[]'), ['class' => 'form-control','resize' => 'none','rows' => '4']) !!}
                            </td>
                            <td>
                                {!! Form::label('output_testcase',trans('module.problems.fields.testCases.output_testcase'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('output_testcase[]',old('output_testcase[]'), ['class' => 'form-control','resize' => 'none','rows' => '4']) !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @if($errors->has('input_testcase.*'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('input_testcase.*') }}
                        </p>
                    @endif
                    @if($errors->has('output_testcase.*'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('output_testcase.*') }}
                        </p>
                    @endif
                </div>
            </div>
            @if($errors->has('input_testcase') or $errors->has('output_testcase'))
                <p class="help-block alert-danger">
                    {{ $errors->first('input_testcase') }}
                </p>
                <br>
                <p>
                    {{ $errors->first('output_testcase') }}
                </p>
            @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('testcase',trans('module.problems.fields.testCases.title'), ['class' => 'control-label']) !!}
                    &nbsp;&nbsp;
                    <input type="button" class="btn btn-success" id="addmorePOIbutton" value="Add" onclick="insRow()"/>
                    &nbsp;
                    <input type="button" class="btn btn-success" id="delPOIbutton" value="Delete"
                           onclick="deleteRow(this)"/>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('time_limit',trans('module.problems.fields.time_limit'), ['class' => 'control-label']) !!}
                    <strong>@lang('module.problems.fields.time_limit_note',['value' => $judge_constraints['max_time_limit']])</strong>
                    {!! Form::number('time_limit', old('time_limit'), ['class' => 'form-control ', 'placeholder' => '', 'min' => '0', 'max' => $judge_constraints['max_time_limit'],'step' => '0.01']) !!}
                    @if($errors->has('time_limit'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('time_limit') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mem_limit',trans('module.problems.fields.mem_limit'), ['class' => 'control-label']) !!}
                    <strong>@lang('module.problems.fields.mem_limit_note',['value' => $judge_constraints['max_mem_limit']])</strong>
                    {!! Form::number('mem_limit', old('grade'), ['class' => 'form-control ', 'placeholder' => '', 'min' => '0', 'max' => $judge_constraints['max_mem_limit']]) !!}
                    @if($errors->has('mem_limit'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('mem_limit') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('code_snippet',trans('module.problems.fields.code_snippet'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('code_snippet', old('code_snippet'), ['class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('code_snippet'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('code_snippet') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('answer_explanation', trans('module.questions.fields.answer-explanation'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('answer_explanation', old('answer_explanation'), ['class' => 'form-control ', 'placeholder' => '','style' => 'resize:none;']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('answer_explanation'))
                        <p class="help-block">
                            {{ $errors->first('answer_explanation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('more_info_link',trans('module.problems.fields.more_info_link'), ['class' => 'control-label']) !!}
                    {!! Form::url('more_info_link', old('more_info_link'), ['class' => 'form-control ']) !!}
                    @if($errors->has('more_info_link'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('more_info_link') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('judge_options',trans('module.judge_options.title'), ['class' => 'control-label']) !!}
                <br>
                @foreach($judge_options as $option)
                    <input type="checkbox" name="judge_options[]"
                           value="{{$option->id}}"> @lang('module.judge_options.options.' . $option->description)
                    <br>
                @endforeach
            </div>
            <hr>
            <div class="form-group">
                {!! Form::label('coding_languages',trans('module.coding_languages.title'), ['class' => 'control-label']) !!}
                <br>
                @foreach($coding_languages as $lang)
                    <input type="checkbox" name="coding_languages[]"
                           value="{{$lang->id}}"> {{ $lang->name }}<br>
                @endforeach
                @if($errors->has('coding_languages'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('coding_languages') }}
                    </p>
                @endif
            </div>
            {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
            {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/problem_js/script.js')}}"></script>
@endsection