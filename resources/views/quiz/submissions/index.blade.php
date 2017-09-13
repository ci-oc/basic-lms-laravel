@extends('layouts.sidebar')
@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            <p>{{Session::get('error')}}</p>
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
                    <th>@lang('module.operations')</th>
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
                            <td>{{ $result->grade == -1 ? trans('module.submissions.stat.cols.pending') : $result->grade }}</td>
                            <td>
                                <a href="{{ route('results.show',[encrypt($result->id)]) }}"
                                   class="btn btn-xs btn-primary {{ $result->processing_status == "PD" ? 'disabled' : '' }}">@lang('module.view')</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang('module.no_entries_in_table')</td>
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