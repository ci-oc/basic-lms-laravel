@extends('layouts.sidebar')
@section('content')
    @if(Auth::user()->can('security-questions-read'))
        <div class="alert alert-warning">
            <a href="{{route('securityQuestions.index')}}"><p class="text-red">@lang('module.admin.answer-note-1')</p>
            </a>
        </div>
    @endif
    <div class="text-center">
        <iframe src="http://free.timeanddate.com/clock/i5utnhtm/n53/tleg/fn2/tcccc/bo2/tt0/ta1"
                frameborder="0" width="301" height="19"></iframe>
    </div>
    <div dir="ltr">
        <div class="col-sm-6 col-md-3">
            <div class="panel visit db mbm">
                <div class="panel-body">
                    <p class="icon">
                        <i class="icon fa fa-graduation-cap"></i>
                    </p>
                    <h4 class="value">
                        <span>{{ $professors_count }}</span></h4>
                    <p class="description">
                        @lang('module.index.professor_count')</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel profit db mbm">
                <div class="panel-body">
                    <p class="icon">
                        <i class="icon fa fa-group"></i>
                    </p>
                    <h4 class="value">
                        <span>{{ $students_count }}</span></h4>
                    <p class="description">
                        @lang('module.index.student_count')</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel income db mbm">
                <div class="panel-body">
                    <p class="icon">
                        <i class="icon fa fa-exclamation fa-fw"></i>
                    </p>
                    <h4 class="value">
                        <span>{{ $quizzes_count }}</span></h4>
                    <p class="description">
                        @lang('module.index.quiz_count')</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="panel task db mbm">
                <div class="panel-body">
                    <p class="icon">
                        <i class="icon fa fa-database fa-fw"></i>
                    </p>
                    <h4 class="value">
                        <span>{{ $submissions_count }}</span></h4>
                    <p class="description">
                        @lang('module.index.submission_count')</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
