@extends('layouts.sidebar')
@section('css')
    <link rel="stylesheet" href="{{asset('css/highlight_styles/default.css')}}">
    <link rel="stylesheet" href="{{asset('css/results/show.css')}}">
@endsection
@section('content')
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
                            <td><strong>{{ $quiz_result->user->name or '' }}</strong>
                                ({{ $quiz_result->user->email or '' }})
                            </td>
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
                    @if(count($questions_results) > 0 || count($problems_results) > 0)
                        <?php $i = 1 ?>
                        @foreach($questions_results as $result)
                            <table class="table table-bordered table-striped">
                                <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                                    <th style="width: 10%">Question #{{ $i }}</th>
                                    <th>{{ $result->question->question_text or '' }}</th>
                                </tr>
                                @if (trim($result->question->code_snippet) != '')
                                    <tr>
                                        <td>Code snippet</td>
                                        <td>
                                            <pre><code class="">{{ $result->question->code_snippet }}</code></pre>
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
                                                    @if ($result->option_id == $option->id) <em>(your
                                                        answer)</em> @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Grade</td>
                                    <td>
                                        {{ $result->grade }} / {{ $result->question->grade }}
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
                                            <pre><code class="">{{ $result->problem->code_snippet }}</code></pre>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Compile Status</td>
                                    <td>
                                        <span class="label label-sm label-{{ $result->compile_status == 'Compiled Successfully' ? 'success' : 'danger' }}">{{ $result->compile_status }}</span>
                                    </td>
                                </tr>
                                @if($result->compile_status == 'Compiled Successfully')
                                    <tr>
                                        <td>Run Status</td>
                                        <td>
                                            <span class="label label-sm label-{{ $result->run_status == 'OK' ? 'success' : 'danger' }}">{{ $result->run_status }}</span>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>Error Reason</td>
                                        <td>
                                            <div class="alert alert-danger" style="border-radius: 0 !important;">
                                                {{ $result->compile_err_reason }}</div>
                                        </td>
                                    </tr>
                                @endif
                                @if($result->compile_err_reason != "Content can't be empty.")
                                    <tr>
                                        <td>Runtime</td>
                                        <td>
                                            {{ $result->time_consumed }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Code</th>
                                    <td>
                                        @if($result->user_code != null)
                                            <pre><code>{{ $result->user_code }}</code></pre>
                                        @else
                                            <p>@lang('module.results.fields.empty_code')</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Language</th>
                                    <td>
                                        {{ strtoupper($result->code_language)}}
                                    </td>
                                </tr>
                                @if($result->run_status == 'OK')
                                    <tr>
                                        <td>Test Cases</td>
                                        <td>
                                            <table class="table table-bordered" id="datatable">
                                                @foreach($result->solvedTestCases as $testcase)
                                                    <?php $i = 1;?>
                                                    <tr>
                                                        <th>Input</th>
                                                        <td>
                                                            <div class="code_snippet">{{$testcase->testcase->input}}</div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Output</th>
                                                        <td>
                                                            Expected <code>"{{ $testcase->testcase->output }}"</code>,
                                                            found <code>"{{$testcase->output}}"</code>. Judge
                                                            <span class="label label-sm label-{{ $testcase->correct == 1 ? 'success' : 'danger' }}">{{ $testcase->correct == 1 ? 'Accepted' : 'Wrong Answer' }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>CPU Usage</th>
                                                        <td>
                                                            {{ $testcase->cpu_usage }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Memory Virtual Size</th>
                                                        <td>
                                                            {{ $testcase->vsize }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>RSS</th>
                                                        <td>
                                                            {{ $testcase->rss}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Grade</td>
                                    <td>
                                        {{ $result->grade }} / {{ $result->problem->grade }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plagiarism</td>
                                    <td>
                                        @if($quiz_result->quiz->checked_for_plagiarism)
                                            @if(count($plagiarism_data) > 0)
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang('module.quizzes.percentage')</th>
                                                        <th>@lang('module.placeholders.name')</th>
                                                        <th>@lang('module.quizzes.percentage')</th>
                                                        <th>@lang('module.problems.lines_matched')</th>
                                                        <th>@lang('module.quizzes.show-for-more-than')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if (count($plagiarism_data) > 0)
                                                        @foreach ($plagiarism_data as $result)
                                                            <tr>
                                                                <td>@if($result->user_1->id == Auth::id())
                                                                        {{$result->plagiarism_percentage_1}}% <strong>(@lang('module.you'))</strong>
                                                                        @else
                                                                        {{$result->plagiarism_percentage_2}}% <strong>(@lang('module.you'))</strong>
                                                                    @endif
                                                                </td>
                                                                <td>@if($result->user_1->id == Auth::id())
                                                                        {{ $result->user_2->name }}
                                                                    @else
                                                                        {{ $result->user_1->name }}
                                                                    @endif
                                                                </td>
                                                                <td>@if($result->user_1->id == Auth::id())
                                                                        {{$result->plagiarism_percentage_2}}%
                                                                    @else
                                                                        {{$result->plagiarism_percentage_1}}%
                                                                    @endif</td>
                                                                <td>{{$result->lines_matched}}</td>
                                                                <td>{{$result->quiz->plagiarism_percentage}}%</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6">@lang('module.no_entries_in_table')</td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            @else
                                                @lang('module.results.fields.no-code-matches')
                                            @endif
                                        @else
                                            @lang('module.submissions.stat.cols.pending')
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Answer Explanation</td>
                                    <td>
                                        {!! $result->problem->answer_explanation or 'No Explanation' !!}
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('js/highlight_editor/highlight.pack.js')}}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection