@extends('layouts.sidebar')
@section('css')
    <style>
        .chart {
            width: 100%;
            min-height: 450px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div id="linechart" class="chart"></div>
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
@endsection