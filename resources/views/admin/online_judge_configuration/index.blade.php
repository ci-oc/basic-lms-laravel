@extends('admin.layout.admin')
@section('content')
    <div class="panel panel-default">
        @if(Session::has('data-success'))
            <div class="alert alert-success">
                <p>@lang('module.admin.memory-time-success')</p>
            </div>
        @endif
        @if(Session::has('error-memory-limit'))
            <div class="alert alert-danger">
                <p>@lang('module.admin.error-memory-limit')</p>
            </div>
        @endif
        @if(Session::has('error-time-limit'))
            <div class="alert alert-danger">
                <p>@lang('module.admin.error-time-limit')</p>
            </div>
        @endif
        <div class="panel-heading">
            <h2 style="color:#1f6377">@lang('module.admin.online-judge-configuration')</h2>
        </div>
        <div class="panel panel-body">
            {!! Form::open(['method' => 'GET', 'route' => ['Judge.store'], 'enctype' => 'multipart/form-data'])!!}
            {{csrf_field()}}
            <br>
            <div class="form-group row" style="margin-left:20%;">
                <div class="col-xs-4">
                    <label for="memory_limit">@lang('module.admin.memory_limit')</label>
                    {!! Form::number('memory_limit',$judge_constraints['max_mem_limit'], ['class' => 'form-control ', 'step' => '0.5','min'=>'0']) !!}
                </div>
                <div class="col-xs-4">
                    <label for="time_limit">@lang('module.admin.time_limit')</label>
                    {!! Form::number('time_limit',$judge_constraints['max_time_limit'], ['class' => 'form-control ', 'step' => '0.5','min'=>'0']) !!}
                </div>
            </div>
            <br>
        </div>
    </div>
    {!! Form::submit(trans('module.submit'), ['class' => 'btn btn-danger']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
