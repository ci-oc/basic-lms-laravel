@extends('layouts.sidebar')
@section('content')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            <p>{{Session::get('error')}}</p>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>
    @endif
    @if(Auth::user()->can('create-quiz'))
        <p>
            <a href="{{route('problems.create')}}"
               class="btn btn-success create_btn {{ count($quizzes) > 0 ? '' : 'disabled' }}">
                @lang('module.addnew')
            </a>
        </p>
    @endif
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
                        {{ $available = QuizHelper::isAvailable($problem->quiz->start_date, $problem->quiz->end_date)}}
                        <tr data-entry-id="{{ encrypt($problem->id) }}">
                            <td>{{ $problem->quiz->course->title }}</td>
                            <td>{{ $problem->quiz->title }}</td>
                            <td>{!! $problem->question_text !!}</td>
                            <td>

                                <a href="{{ route('problems.show',encrypt($problem->id)) }}"
                                   class="btn btn-xs btn-primary">@lang('module.view')</a>
                                <a href="{{ route('problems.edit',encrypt($problem->id)) }}"
                                   class="btn btn-xs btn-info {{ $available ? 'disabled' : ''}}">@lang('module.edit')</a>
                                @if(!$available)
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                        'route' => ['problems.destroy', encrypt($problem->id)])) !!}
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