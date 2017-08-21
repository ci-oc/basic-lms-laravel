@inject('request','App\Quiz')
@extends('layouts.sidebar')
@section('content')
    @if(Session::has('done_already'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-quiz-made-before')</p>
        </div>
    @endif
    @if(!Auth::user()->isStudent())
        <p>
            <a href="{{route('quizzes.create')}}"
               class="btn btn-success create_btn">
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
                                <a href="{{ route('quizzes.show',[$quiz->id]) }}"
                                   class="btn btn-xs btn-primary {{ $available ? '' : 'disabled'}}">@lang('module.view')</a>
                                @if(count($solved_quizzes) > 0)
                                    @foreach($solved_quizzes as $solved_quiz)
                                        @if($solved_quiz->quiz->id == $quiz->id)
                                            @if(floatval($solved_quiz->grade) != null)
                                                <span class="label label-success">@lang('module.quizzes.fields.done')</span>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                                @if(Auth::user()->isInstructor())
                                    <a href="{{ route('quizzes.edit',[$quiz->id]) }}"
                                       class="btn btn-xs btn-info {{ $available ? 'disabled' : ''}}">@lang('module.edit')</a>
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
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection