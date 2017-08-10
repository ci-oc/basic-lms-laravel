@extends('layouts.sidebar')
@section('content')
    <a href="{{route('problems.create')}}" class="btn bg-primary create_btn">
        Add New
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.problems.problems-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('module.courses.fields.course')</th>
                        <th>@lang('module.quizzes.fields.question-text')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection