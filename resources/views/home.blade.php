@extends('layouts.sidebar')
@section('content')
    @if(Auth::user()->can('security-questions-read'))
        <div class="alert alert-warning">
          <a href="{{route('securityQuestions.index')}}"><p class="text-red">@lang('module.admin.answer-note-1')</p></a>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center">
                    <iframe src="http://free.timeanddate.com/clock/i5utnhtm/n53/tleg/fn2/tcccc/bo2/tt0/ta1"
                            frameborder="0" width="301" height="19"></iframe>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
