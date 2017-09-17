@extends('layouts.sidebar')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{!! Session::get('success') !!}</div>
    @endif
    @if (Session::has('failure'))
        <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
    @endif
    @if(Session::has('error-saving'))
        <div class="alert alert-danger">
            <p>{{Session::get('error-saving')}}</p>
        </div>
    @endif
    {!! Form::open(['method' => 'PUT', 'route' => ['problems.update', $id]]) !!}
    <input type="hidden" name="id" value="{{$id}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.edit')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question_text',trans('module.problems.fields.problem_desc'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('question_text', $problem->question_text, ['class' => 'form-control ', 'placeholder' => 'Type Problem Description','resize' => 'none', 'required']) !!}
                    @if($errors->has('question_text'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('question_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('grade',Lang::get('module.problems.fields.problem_grade'), ['class' => 'control-label']) !!}
                    {!! Form::number('grade', $problem->grade, ['class' => 'form-control ', 'placeholder' => '', 'step' => '0.5', 'required']) !!}
                    @if($errors->has('grade'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('grade') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('input_format',Lang::get('module.problems.fields.input_format'), ['class' => 'control-label']) !!}
                    {!! Form::text('input_format', $problem->input_format, ['class' => 'form-control ', 'placeholder' => 'Type Input Format', 'required']) !!}
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
                    {!! Form::text('output_format', $problem->output_format, ['class' => 'form-control ', 'placeholder' => 'Type Output Format', 'required']) !!}
                    @if($errors->has('output_format'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('output_format') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('test_cases',Lang::get('module.problems.fields.test_cases'), ['class' => 'control-label']) !!}
                    <table id="dataTable" class="table">
                        <tbody>
                        @foreach($problem->testcases as $testcases)
                            <tr>
                                <td>
                                    {!! Form::label('input_testcase',trans('module.problems.fields.testCases.input_testcase'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('input_testcase[]',$testcases->input, ['class' => 'form-control','resize' => 'none','rows' => '4', 'required']) !!}
                                </td>
                                <td>
                                    {!! Form::label('output_testcase',trans('module.problems.fields.testCases.output_testcase'), ['class' => 'control-label']) !!}
                                    {!! Form::textarea('output_testcase[]',$testcases->output, ['class' => 'form-control','resize' => 'none','rows' => '4', 'required']) !!}
                                </td>
                            </tr>
                        @endforeach
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
                    <strong>@lang('module.problems.fields.time_limit_note')</strong>
                    {!! Form::number('time_limit', $problem->time_limit, ['class' => 'form-control ', 'placeholder' => '', 'min' => '0', 'max' => '60','step' => '0.01', 'required']) !!}
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
                    <strong>@lang('module.problems.fields.mem_limit_note')</strong>
                    {!! Form::number('mem_limit', $problem->mem_limit, ['class' => 'form-control ', 'placeholder' => '', 'min' => '0', 'max' => '30720', 'required'
                    ]) !!}
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
                    <span><strong>(@lang('module.not_required'))</strong></span>
                    {!! Form::textarea('code_snippet', $problem->code_snippet, ['class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('code_snippet'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('code_snippet') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('more_info_link',trans('module.problems.fields.more_info_link'), ['class' => 'control-label']) !!}
                    <span><strong>(@lang('module.not_required'))</strong></span>
                    {!! Form::url('more_info_link', $problem->more_info_link, ['class' => 'form-control ']) !!}
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
                           {{in_array($option->id,$problem_judge_options)?"checked":""}}
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
                           {{in_array($lang->id,$problem_coding_languages)?"checked":""}}
                           value="{{$lang->id}}"> {{ $lang->name }}<br>
                @endforeach
            </div>

            {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/problem_js/script.js')}}"></script>

@endsection