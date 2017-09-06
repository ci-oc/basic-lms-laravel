@extends('admin.layout.admin')
@section('content')
    <h2>Questions Table</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Question</th>
            <th>answer</th>
            <th>operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($security_Question as $question)
            <tr>
                <td>{{$question['question_text']}}</td>
                <td>{{$question['answer']}}</td>
                <td><a href="{{ route('securityQuestions.edit',[$question['id']]) }}"
                       class="btn btn-xs btn-info">@lang('module.edit')</a>
                    <a href="{{ route('securityQuestions.destroy',[$question['id']]) }}"
                       class="btn btn-xs btn-danger">@lang('module.delete')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
