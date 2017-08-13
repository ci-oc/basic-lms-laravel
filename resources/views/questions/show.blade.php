@extends('layouts.sidebar')

@section('content')
    <h3 class="page-title">@lang('module.questions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('module.questions.fields.quiz')</th>
                            <td>{{ $question->quiz->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.question-text')</th>
                            <td>{!! $question->question_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.code-snippet')</th>
                            <td><pre>{!! $question->code_snippet !!}</pre></td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.answer-explanation')</th>
                            <td>{!! $question->answer_explanation !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('module.questions.fields.more-info-link')</th>
                            <td>{{ $question->more_info_link }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('questions.index') }}" class="btn bg-success">@lang('module.back_to_list')</a>
        </div>
    </div>
@stop