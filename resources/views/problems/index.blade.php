@extends('layouts.sidebar')
@section('content')
    <p>
    <a href="{{route('problems.create')}}"
       class="btn btn-success create_btn {{ count($problems) > 0 ? 'datatable' : '' }} dt-select">
        Add New
    </a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.problems.problems-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.questions.fields.quiz')</th>
                    <th>@lang('module.quizzes.fields.question-text')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($problems) > 0)
                    @foreach ($problems as $problem)
                        <tr data-entry-id="{{ $problem->id }}">
                            <td>{{ $problem->quiz->course->title }}</td>
                            <td>{{ $problem->quiz->title or '' }}</td>
                            <td>{!! $problem->question_text !!}</td>
                            <td>

                                <a href="{{ route('questions.show',[$problem->id]) }}"
                                   class="btn btn-xs btn-primary">@lang('module.view')</a>
                                <a href="{{ route('questions.edit',[$problem->id]) }}"
                                   class="btn btn-xs btn-info">@lang('module.edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                    'route' => ['questions.destroy', $problem->id])) !!}
                                {!! Form::submit(trans('module.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
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