@extends('admin.layout.admin')
@section('content')
    @if(Session::has('success-deletion'))
    <div class="alert alert-success">
        <p>@lang('module.admin.success-deletion')</p>
    </div>
    @endif
    <a class="btn btn-success" href="{{route('securityQuestions.index3')}}">Add Question</a>
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
                    {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'route' => ['securityQuestions.destroy', $question['id']])) !!}
                    {!! Form::submit(trans('Delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
