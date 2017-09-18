@extends('layouts.sidebar')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('module.questions.fields.quiz')</th>
                            <td>{{ $problem->quiz->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.problem_desc')</th>
                            <td>{!! $problem->question_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.problem_grade')</th>
                            <td>{{ $problem->grade }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.input_format')</th>
                            <td>{{ $problem->input_format }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.output_format')</th>
                            <td>{{ $problem->output_format }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.time_limit')</th>
                            <td>{{ $problem->time_limit }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.problems.fields.mem_limit')</th>
                            <td>{{ $problem->mem_limit }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.code-snippet')</th>
                            <td><pre>{{ $problem->code_snippet or trans('module.results.fields.empty_code')}}</pre></td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.more-info-link')</th>
                            <td>{{ $problem->more_info_link or trans('module.problems.no_more_info')}}</td>
                        </tr>

                    </table>
                </div>
            </div>
            <p>&nbsp;</p>
            <a href="{{ route('problems.index') }}" class="btn bg-success">@lang('module.back_to_list')</a>
        </div>
    </div>
@endsection