@extends('layouts.sidebar')

@section('content')
    <p>
        <a href="{{ route('questions.create') }}" class="btn btn-success">@lang('module.addnew')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>
                    <th>@lang('module.questions.fields.quiz')</th>
                    <th>@lang('module.questions.fields.question-text')</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($questions) > 0)
                    @foreach ($questions as $question)
                        <tr data-entry-id="{{ $question->id }}">
                            <td></td>
                            <td>{{ $question->quiz->title or '' }}</td>
                            <td>{!! $question->question_text !!}</td>
                            <td>
                                <a href="{{ route('questions.show',[$question->id]) }}"
                                   class="btn btn-xs btn-primary">@lang('module.view')</a>
                                <a href="{{ route('questions.edit',[$question->id]) }}"
                                   class="btn btn-xs btn-info">@lang('module.edit')</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("module.are_you_sure")."');",
                                    'route' => ['questions.destroy', $question->id])) !!}
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
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('questions.massDestroy') }}';
    </script>
@endsection