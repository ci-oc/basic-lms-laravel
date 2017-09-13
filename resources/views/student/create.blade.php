@extends('layouts.sidebar')
@section('content')
    @if(Session::has('failed_saving_file'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-saving')</p>
        </div>
    @endif


    @if(Session::has('name_field_failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-name-field')</p>
        </div>
    @endif

    @if(Session::has('email_field_failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-email-field')</p>
        </div>
    @endif

    @if(Session::has('id_field_failed'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-id-field')</p>
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
            {!! Form::open(['method' => 'POST', 'route' => ['users.store_single']])!!}
            {{ csrf_field() }}
            <div class="form-body pal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                {!! Form::text('name', old('name'), ['required','class' => 'form-control ', 'placeholder' => trans('module.placeholders.name')]) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                {!! Form::text('email', null,  ['required','class'=>'form-control','placeholder'=> trans('module.placeholders.email')]) !!}
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
            {{ csrf_field() }}
            <div class="form-body pal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('excel-sheet', trans('module.courses.fields.excel'), ['class' => 'control-label']) !!}
                            <strong><a href="/downloadTemp" style="color: deepskyblue; cursor: pointer;">@lang('module.click.name') , @lang('module.click.fields.download-temp')</a></strong>
                            <br><br>
                            {!! Form::file('file', null,['required','class' => 'close fileupload-exists']) !!}
                            @if($errors->has('file'))
                                <p class="help-block alert-danger">
                                    {{ $errors->first('file') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form-overview').on('submit', function() {
                setInterval(function(){
                    $.getJSON('/progress', function(data) {
                        $('#progress').html(data[0]);
                    });
                }, 1000);

                $.post(
                    $(this).prop('action'),
                    {"_token": $(this).find('input[name=_token]').val()},
                    function() {
                        window.location.href = 'success';
                    },
                    'json'
                );

                return false;
            });
        });
    </script>
@stop