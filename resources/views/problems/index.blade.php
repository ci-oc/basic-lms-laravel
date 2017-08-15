@extends('layouts.sidebar')
@section('content')
    <p>
        <a href="{{route('problems.create')}}"
           class="btn btn-success create_btn">
            Add New
        </a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.problems.problems-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped" id="{{ count($problems) > 0 ? 'datatable' : '' }}">
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
                        <?php $available = strtotime($problem->quiz->start_date) < time() && time() < strtotime($problem->quiz->end_date) ? true : false ?>
                        <tr data-entry-id="{{ $problem->id }}">
                            <td>{{ $problem->quiz->course->title }}</td>
                            <td>{{ $problem->quiz->title or '' }}</td>
                            <td>{!! $problem->question_text !!}</td>
                            <td>

                                <a href="{{ route('questions.show',[$problem->id]) }}"
                                   class="btn btn-xs btn-primary {{ $available ? 'disabled' : ''}}">@lang('module.view')</a>
                                <a href="{{ route('questions.edit',[$problem->id]) }}"
                                   class="btn btn-xs btn-info {{ $available ? 'disabled' : ''}}">@lang('module.edit')</a>
                                @if(!$available)
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                        'route' => ['questions.destroy', $problem->id])) !!}
                                    {!! Form::submit(trans('module.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endif
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
            $('#datatable').DataTable();
        });
    </script>
@endsection