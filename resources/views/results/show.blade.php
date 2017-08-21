@extends('layouts.sidebar')
@section('css')
    <style>
        .test-option-true {
            background-color: #4CAF50 !important;
            color: white;
        }

        .test-option-true-mini {
            color: #4CAF50 !important;
        }

        .test-option-false {
            background-color: #f44336 !important;
            color: white;
        }

        .test-option-false-mini {
            color: #f44336 !important;
        }
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
    <h3 class="page-title">@lang('module.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.results.fields.view-result')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('module.results.fields.user')</th>
                            <td>{{ $quiz_result->user->name or '' }} ({{ $quiz_result->user->email or '' }})</td>
                        </tr>
                        <tr>
                            <th>@lang('module.results.fields.date')</th>
                            <td>{{ $quiz_result->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.results.fields.result')</th>
                            <td>{{ $quiz_result->grade }} / {{$quiz_result->quiz->full_mark}}</td>
                        </tr>
                    </table>
                    <?php $i = 1 ?>
                    @foreach($questions_results as $result)
                        <table class="table table-bordered table-striped">
                            <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                                <th style="width: 10%">Question #{{ $i }}</th>
                                <th>{{ $result->question->question_text or '' }}</th>
                            </tr>
                            @if ($result->question->code_snippet != '')
                                <tr>
                                    <td>Code snippet</td>
                                    <td>
                                        <div class="code_snippet">{!! $result->question->code_snippet !!}</div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Options</td>
                                <td>
                                    <ul>
                                        @foreach($result->question->options as $option)
                                            <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                            @if ($result->option_id == $option->id) text-decoration: underline @endif">{{ $option->option }}
                                                @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                                @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer Explanation</td>
                                <td>
                                    {!! $result->question->answer_explanation  !!}
                                    @if ($result->question->more_info_link != '')
                                        <br>
                                        <br>
                                        Read more:
                                        <a href="{{ $result->question->more_info_link }}"
                                           target="_blank">{{ $result->question->more_info_link }}</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <?php $i++ ?>
                    @endforeach
                    @foreach($problems_results as $result)
                        <table class="table table-bordered table-striped">
                            <tr class="test-option{{ $result->problem->grade == $result->grade ? '-true' : '-false' }}">
                                <th style="width: 10%">Question #{{ $i }}</th>
                                <th>{{ $result->problem->question_text or '' }}</th>
                            </tr>
                            @if ($result->problem->code_snippet != '')
                                <tr>
                                    <td>Code snippet</td>
                                    <td>
                                        <div class="code_snippet">{!! $result->problem->code_snippet !!}</div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>Test Cases</td>
                                <td>
                                    <div class="col-xs-12 form-group">
                                        <div class="col-sm-8">
                                            <table class="table table-bordered">
                                                @foreach($testcases_results as $testcase)
                                                    @if($testcase->problem_id == $result->problem_id)
                                                        <tr>
                                                            <th>Input</th>
                                                            <td> <div class="code_snippet">{{$testcase->testcase->input}}</div></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Code</th>
                                                            <td>
                                                                <div class="code_snippet">{!! $result->user_code  !!}</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Output</th>
                                                            <td>
                                                                Expected {{ $testcase->testcase->output }}, found {{$testcase->output}}. Judge
                                                                <span class="label label-sm label-{{ $testcase->correct == 1 ? 'success' : 'danger' }}">{{ $testcase->correct == 1 ? 'Accepted' : 'Wrong Answer' }}</span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer Explanation</td>
                                <td>
                                    {!! $result->problem->answer_explanation  !!}
                                    @if ($result->problem->more_info_link != '')
                                        <br>
                                        <br>
                                        Read more:
                                        <a href="{{ $result->problem->more_info_link }}"
                                           target="_blank">{{ $result->problem->more_info_link }}</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <?php $i++ ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
