@extends('layouts.sidebar')
@section('content')
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
                                {!! Form::text('name', old('name'), ['class' => 'form-control ', 'placeholder' => Lang::get('module.placeholders.name')]) !!}
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
                                {!! Form::text('college_id', old('college_id'), ['class' => 'form-control ', 'placeholder' => Lang::get('module.placeholders.college-id')]) !!}
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