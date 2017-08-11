@extends('layouts.sidebar')
@section('content')
<?php
		$quizzes = array('question1','question1','question1');
?>
@extends('layouts.sidebar')
@section('content')
    <a href="{{route('quizzes.create')}}" class="btn btn-success create_btn {{ count($quizzes) > 0 ? 'datatable' : '' }} dt-select">
        Add New
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.quizzes.quizzes-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('module.quizzes.fields.quiz')</th>
                        <th>@lang('module.courses.fields.course')</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>

                </tbody>
            </table>
        </div>
    </div>



@endsection
@endsection