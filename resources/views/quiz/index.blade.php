@extends('layouts.sidebar')
@section('content')
    <p>
        <a href="{{route('quizzes.create')}}"
           class="btn btn-success create_btn">
            Add New
        </a>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.quizzes.quizzes-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped" id="{{ $quizzes > 0 ? 'datatable' : ''}}">
                <thead>
                <tr>
                    <th>@lang('module.quizzes.fields.quiz')</th>
                    <th>@lang('module.courses.fields.course')</th>
                    <th>@lang('module.created_at')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($quizzes) > 0)
                    @foreach ($quizzes as $quiz)
                        <tr data-entry-id="{{ $quiz->id }}">
                            <td>{{ $quiz->title or '' }}</td>
                            <td>{!! $quiz->course->title !!}</td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>
                                <a href="{{ route('quizzes.show',[$quiz->id]) }}"
                                   class="btn btn-xs btn-primary {{ strtotime($quiz->start_date) < time() && time() < strtotime($quiz->end_date)? '' : 'disabled'}}">@lang('module.view')</a>
                                @if(Auth::user()->isInstructor())
                                <a href="{{ route('quizzes.edit',[$quiz->id]) }}"
                                   class="btn btn-xs btn-info {{ strtotime($quiz->start_date) < time() && time() < strtotime($quiz->end_date)? '' : 'disabled'}}">@lang('module.edit')</a>
                                {!! Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                'route' => ['quizzes.destroy', $quiz->id])) !!}
                                {!! Form::submit(trans('Delete'), array('class' => 'btn btn-xs btn-danger')) !!}
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