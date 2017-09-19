@extends('layouts.sidebar')
@section('content')
    @if(Auth::user()->can('solve-quiz'))
        <div class="row">
            <div class="form-group col-xs-12"><a href="{{ route('results.index') }}" class="h4"
                                                 style="float: right;"><u>@lang('module.results.title')</u></a>
            </div>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.list')
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped datatable dataTable" id="datatable">
                <thead>
                <tr>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.quizzes.create-questions-title')</th>
                    <th>@lang('module.problems.problem-name')</th>
                    <th>@lang('module.placeholders.name')</th>
                    <th>@lang('module.quizzes.percentage')</th>
                    <th>@lang('module.placeholders.name')</th>
                    <th>@lang('module.quizzes.percentage')</th>
                    <th>@lang('module.problems.lines_matched')</th>
                    <th>@lang('module.quizzes.show-for-more-than')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($plagiarism_results) > 0)
                    @foreach ($plagiarism_results as $result)
                        <tr>
                            <td>{{ $result->quiz->course->title }}</td>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->problem->question_text }}</td>
                            <td>{{ $result->user_1->name }}</td>
                            <td><em>{{$result->plagiarism_percentage_1}}%</em></td>
                            <td>{{ $result->user_2->name }}</td>
                            <td><em>{{$result->plagiarism_percentage_1}}%</em></td>
                            <td>{{$result->lines_matched}}</td>
                            <td><em>{{$result->quiz->plagiarism_percentage}}%</em></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9">@lang('module.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                responsive: true
            });
        });

    </script>
@endsection