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
            <a href="{{ route('questions.create') }}"
               class="btn btn-success {{ count($quizzes) > 0 ? '' : 'disabled' }}">@lang('module.addnew')</a>
        </p>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.questions.question-list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped" id="{{ count($questions) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.questions.fields.quiz')</th>
                    <th>@lang('module.questions.fields.question-text')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if (count($questions) > 0)
                    @foreach ($questions as $question)
                        {{ $available = QuizHelper::isAvailable($question->quiz->start_date, $question->quiz->end_date)}}
                        <tr data-entry-id="{{ $question->id }}">
                            <td>{{ $question->quiz->course->title }}</td>
                            <td>{{ $question->quiz->title or '' }}</td>
                            <td>{!! $question->question_text !!}</td>
                            <td>
                                <a href="{{ route('questions.show',[encrypt($question->id)]) }}"
                                   class="btn btn-xs btn-primary">@lang('module.view')</a>
                                @if(Auth::user()->can('edit-quiz'))
                                    <a href="{{ route('questions.edit',[encrypt($question->id)]) }}"
                                       class="btn btn-xs btn-info {{ $available ? 'disabled' : ''}}">@lang('module.edit')</a>
                                @endif
                                @if(!$available)
                                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'class' => $available ? 'disabled' : '',
                                    'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                    'route' => ['questions.destroy', encrypt($question->id)])) !!}
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
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('questions.massDestroy') }}';
    </script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection