@inject('request','App\Quiz')
@extends('layouts.sidebar')
@section('content')
    @if(Session::has('success-creation'))
        <div class="alert alert-success">
            <p>@lang('module.success.quiz-created-successfully')</p>
        </div>
    @endif
    @if(Session::has('done_already'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-quiz-made-before')</p>
        </div>
    @endif
    @if(Session::has('not_available'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-quiz-not-available')</p>
        </div>
    @endif
    @if(Session::has('0_questions'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-0-questions')</p>
        </div>
    @endif
    @if(Session::has('courses_0'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-0-courses')</p>
        </div>
    @endif
    @if(Session::has('none-solved'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-none-solved')</p>
        </div>
    @endif
    @if(Session::has('cannot_modify'))
        <div class="alert alert-danger">
            <p>{{Session::get('cannot_modify')}}</p>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>
    @endif
    @if(Auth::user()->can('create-quiz'))
        <p>
            <a href="{{route('quizzes.create')}}"
               class="btn btn-success create_btn {{ count($courses) > 0 ? '' : 'disabled' }}">
                @lang('module.addnew')
            </a>
        </p>
    @endif
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
                    <th>@lang('module.quizzes.fields.start-date')</th>
                    <th>@lang('module.quizzes.fields.end-date')</th>
                    <th>@lang('module.created_at')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($quizzes) > 0)
                    @foreach ($quizzes as $quiz)
                        <?php
                        $available = $request->isAvailable($quiz->start_date, $quiz->end_date);
                        ?>
                        <tr data-entry-id="{{ $quiz->id }}" class="{{ $available ? 'success' : '' }}">
                            <td>{{ $quiz->title or '' }}</td>
                            <td>{!! $quiz->course->title !!}</td>
                            <td>{!! $quiz->start_date !!}</td>
                            <td>{!! $quiz->end_date !!}</td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>
                                @if(Auth::user()->can('solve-quiz'))
                                    <a href="{{ route('quizzes.show',[encrypt($quiz->id)]) }}"
                                       class="btn btn-xs btn-primary {{ $available ? '' : 'disabled'}}">@lang('module.quizzes.solve')</a>
                                @endif
                                @if(Auth::user()->can('edit-quiz'))
                                    <a href="{{ route('quizzes.edit',[encrypt($quiz->id)]) }}"
                                       class="btn btn-xs btn-info {{ $available ? 'disabled' : ''}}">@lang('module.edit')</a>
                                @endif
                                @if(Auth::user()->can('show-quiz-statistics'))
                                    <a href="{{ route('quizzes.chart',[encrypt($quiz->id)]) }}"
                                       class="btn btn-xs btn-dark">@lang('module.stat')</a>
                                @endif
                                @if(Auth::user()->can('show-quiz-results'))
                                    <a href="{{ route('quizzes.results',[encrypt($quiz->id)]) }}"
                                       class="btn btn-xs btn-warning">@lang('module.submissions.title')</a>
                                @endif
                                @if(Auth::user()->can('delete-quiz'))
                                    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                            'route' => ['quizzes.destroy', encrypt($quiz->id)])) !!}
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
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection