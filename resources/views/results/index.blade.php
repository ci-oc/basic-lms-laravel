@extends('layouts.sidebar')
@section('content')
    <h3 class="page-title">@lang('module.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped datatable dataTable">
                <thead>
                <tr>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.quizzes.create-questions-title')</th>
                    <th>@lang('module.results.fields.date')</th>
                    <th>@lang('module.results.table-result')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($results) > 0)
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->quiz->course->title }}</td>
                            <td>{{ $result->quiz->title }}</td>
                            <td>{{ $result->created_at or '' }}</td>
                            <td>{{ $result->grade }} / {{$result->quiz->full_mark}}</td>
                            <td>
                                <a href="{{ route('results.show',[$result->id]) }}"
                                   class="btn btn-xs btn-primary">@lang('module.view')</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection