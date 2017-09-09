@extends('layouts.sidebar')
@section('content')
    @if(Auth::user()->isStudent())
        <div class="row">
            <div class="form-group col-xs-12"><a href="{{ route('results.index') }}" class="h4"
                                                 style="float: right;"><u>@lang('module.results.title')</u></a>
            </div>
        </div>
    @endif
    @include('stat_cols')
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.list')
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped datatable dataTable" id="datatable">
                <thead>
                <tr>
                    <th>@lang('module.placeholders.name')</th>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.quizzes.create-questions-title')</th>
                    <th>@lang('module.results.fields.date')</th>
                    <th>@lang('module.quizzes.fields.full-mark')</th>
                    <th>@lang('module.results.table-result')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($submissions) > 0)
                    @foreach ($submissions as $result)
                        <tr class="{{ $result->processing_status == "PD" ? 'info' : ($result->grade >= ((9/10)*$result->quiz->full_mark) ? 'success' : (
                        $result->grade >= ((5/10)*$result->quiz->full_mark) ? 'warning' : 'danger')) }}">
                            <td>{{ $result->user->name }}</td>
                            <td>{{ $result->quiz->course->title }}</td>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->created_at or '' }}</td>
                            <td>{{$result->quiz->full_mark}}</td>
                            <td>{{ $result->processing_status == "PD"? trans('module.submissions.stat.cols.pending') : $result->grade }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('module.no_entries_in_table')</td>
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