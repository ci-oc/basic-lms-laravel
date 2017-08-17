@extends('layouts.sidebar')
@section('content')
    @if(Session::has('failed_saving_file'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-saving')</p>
        </div>
    @endif
    @if(Session::has('data'))
        @if((Session::get('data')) == null)
            <div class="alert alert-info">
                <p>@lang('module.success.success-saving')</p>
            </div>
        @else
            <div class="alert alert-danger">
                <p>@lang('module.errors.error-create-user')</p>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>@lang('module.placeholders.name')</th>
                        <th>@lang('module.placeholders.email')</th>
                        <th>@lang('module.placeholders.college-id')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(Session::get('data') as $user)
                        <tr>
                            <td>{{ $user['name']}}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['college_id'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
    <div class="panel panel-grey">
        <div class="panel-heading">
            @lang('module.users.new-users')
        </div>
        <div class="panel-body pan">
            {!! Form::open(['method' => 'POST', 'route' => ['users.store']])!!}
            <div class="form-body pal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                {!! Form::text('name', old('name'), ['required','class' => 'form-control ', 'placeholder' => Lang::get('module.placeholders.name')]) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                {!! Form::text('email', null,  ['required','class'=>'form-control','placeholder'=> Lang::get('module.placeholders.email')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-id-card"></i>
                                {!! Form::text('college_id', old('college_id'), ['required','class' => 'form-control ', 'placeholder' => Lang::get('module.placeholders.college-id')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
                {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <div class="panel panel-green">
        <div class="panel-heading">
            @lang('module.users.new-users-excel')
        </div>
        <div class="panel-body pan">
            {!! Form::open(['method' => 'POST', 'route' => ['users.store'],'files'=> true, 'enctype' => 'multipart/form-data'])!!}
            <div class="form-body pal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('excel-sheet', Lang::get('module.courses.fields.excel'), ['class' => 'control-label']) !!}
                            {!! Form::file('file', null,['class' => 'close fileupload-exists']) !!}
                            @if($errors->has('file'))
                                <p class="help-block alert-danger">
                                    {{ $errors->first('file') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection