@extends('layouts.sidebar')
@section('content')
	<script type="text/javascript" src="{{ asset('js/problem_js/script.js')}}"></script>
    <h3 class="page-title">@lang('module.problems.new_problem')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['problems.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('selected_quiz',Lang::get('module.problems.fields.selected_quiz'), ['class' => 'control-label']) !!}
                    <select class="form-control">
                    	<option>5ra</option>
                    	<option>nela</option>
                    </select>
					@if($errors->has('problem_description'))	
                        <p class="help-block alert-danger">
                            {{ $errors->first('problem_description') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('problem_description',Lang::get('module.problems.fields.problem_desc'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('problem_description', old('problem_description'), ['class' => 'form-control ', 'placeholder' => 'Type Problem Description','resize' => 'none']) !!}
                    @if($errors->has('problem_description'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('problem_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
					{!! Form::label('problem_grade',Lang::get('module.problems.fields.problem_grade'), ['class' => 'control-label']) !!}
                    {!! Form::number('problem_grade', old('problem_grade'), ['class' => 'form-control ', 'placeholder' => 'Type Problem Grade',]) !!}
                    @if($errors->has('problem_grade'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('problem_grade') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
					{!! Form::label('input_format',Lang::get('module.problems.fields.input_format'), ['class' => 'control-label']) !!}
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
					{!! Form::label('test_cases',Lang::get('module.problems.fields.test_cases'), ['class' => 'control-label']) !!}

					@for($i=0; $i<3; $i++)
						<table id="dataTable" class="table">
                            <tbody>
                                <tr>
                                    <p>
                                    	<td><input type="checkbox" required="required" name="chk[]" checked="checked" /></td>
                                        <td>
                                        	{!! Form::label('input_testcase',Lang::get('module.problems.fields.testCases.input_testcase'), ['class' => 'control-label']) !!}
                                        	{!! Form::textarea('input_testcase[]',old('input_testcase[]'), ['class' => 'form-control','resize' => 'none','rows' => '4']) !!}
                                        </td>
                                        <td>
                                            {!! Form::label('output_testcase',Lang::get('module.problems.fields.testCases.output_testcase'), ['class' => 'control-label']) !!}
                                            {!! Form::textarea('output_testcase[]',old('output_testcase[]'), ['class' => 'form-control','resize' => 'none','rows' => '4']) !!}
                                        </td>
                                    </p>
                                </tr>
                            </tbody>
                        </table>
					@endfor
                </div>
            </div>
            <div class="row">
            	<div class="col-xs-12 form-group">
            	    {!! Form::label('testcase',Lang::get('module.problems.fields.testCases.title'), ['class' => 'control-label']) !!} &nbsp;&nbsp; 
            		<button type="button" class="btn btn-success" id="add[]" onclick="addRow('dataTable')">Add</button>
            		&nbsp;
            		<button type="button" class="btn btn-success" id="remove[]" onclick="deleteRow('dataTable')">Remove</button>
            	</div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
					{!! Form::label('code_snippet',Lang::get('module.problems.fields.code_snippet'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('code_snippet', old('code_snippet'), ['class' => 'form-control ','resize' => 'none','rows' => '6']) !!}
                    @if($errors->has('output_format'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('output_format') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
					{!! Form::label('more_info_link',Lang::get('module.problems.fields.more_info_link'), ['class' => 'control-label']) !!}
                    {!! Form::url('more_info_link', old('more_info_link'), ['class' => 'form-control ','placeholder' => 'Type an URL']) !!}
                    @if($errors->has('output_format'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('output_format') }}
                        </p>
                    @endif
                </div>
            </div>
            <br>
            <br>
            {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
   			{!! Form::close() !!}
    	</div>
    </div>
@endsection
