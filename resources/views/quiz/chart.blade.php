@extends('layouts.sidebar')
@section('css')
    <link rel="stylesheet" href="{{asset('css/highlight_styles/default.css')}}">
    <style>
        .chart {
            width: 100%;
            min-height: 450px;
        }

        pre {
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div id="linechart" class="chart"></div>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-striped table-inverse">

                <thead>
                <tr>
                    <th>@lang('module.charts.statistics')</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>@lang('module.charts.got_full_mark')</td>
                    <td>{{ $full_mark_count }}</td>
                </tr>

                <tr>
                    <td>@lang('module.charts.not_passed')</td>
                    <td>{{ $failed_count }}</td>
                </tr>

                </tbody>

            </table>
            <hr size="10">
            <h3>@lang('module.charts.least_solved')</h3>
            <table class="table table-striped table-bordered">
                <tr class="{{ $minimum_problem_percentage > 50 ? 'info' : 'warning' }}">
                    <th>@lang('module.problems.solving_percentage')</th>
                    <td>{{$minimum_problem_percentage}}%</td>
                </tr>
                <tr>
                    <th>@lang('module.questions.fields.question-text')</th>
                    <td>{{$minimum_problem->question_text}}</td>
                </tr>
                <tr>
                    <th>@lang('module.problems.fields.code_snippet')</th>
                    <td>
                        <pre><code>{{$minimum_problem->code_snippet or trans('module.results.fields.empty_code')}}</code></pre>
                    </td>
                </tr>
                <tr>
                    <th>@lang('module.problems.fields.problem_grade')</th>
                    <td>{{$minimum_problem->grade}} @lang('module.questions-options.fields.grade')</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("visualization", "1", {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable({!! $chart_data  !!});

            var options = {
                colors: ['#990000'],
                pointSize: 10,
                pointColor: '#fff',
                title: 'Quiz Chart',
                curveType: 'function'
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);
        }

        $(window).resize(function () {
            drawChart();
        });
    </script>
    <script src="https://www.google.com/jsapi"></script>
    <script src="{{asset('js/highlight_editor/highlight.pack.js')}}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection