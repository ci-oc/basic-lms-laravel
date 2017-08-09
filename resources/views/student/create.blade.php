@extends('layouts.sidebar')
@section('content')
    <h3 class="page-title">@lang('module.results.title')</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading">
                @lang('module.list')
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@lang('module.results.fields.date')</th>
                            <th>Result</th>
                            <th>View Result</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@if (count($results) > 0)--}}
                            {{--@foreach ($results as $result)--}}
                                {{--<tr>--}}
                                    {{--@if(Auth::user()->isAdmin())--}}
                                        {{--<td>{{ $result->user->name or '' }} ({{ $result->user->email or '' }})</td>--}}
                                    {{--@endif--}}
                                    {{--<td>{{ $result->created_at or '' }}</td>--}}
                                    {{--<td>{{ $result->result }}/10</td>--}}
                                    {{--<td>--}}
                                        {{--<a href=""--}}
                                           {{--class="btn btn-xs btn-primary">@lang('module.view')</a>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            <tr>
                                <td colspan="6">@lang('module.no_entries_in_table')</td>
                            </tr>
                        {{--@endif--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection