@section('css')
    <style type="text/css">
        [hidden] {
            display: none !important;
        }
    </style>
@endsection
@extends('layouts.sidebar')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{!! Session::get('success') !!}</div>
    @endif
    @if (Session::has('failure'))
        <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
    @endif
    <!--BEGIN CONTENT-->
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">

                    <div class="col-md-12">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>

                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mtl">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="text-center mbl"><img
                                                    class="img-responsive img-circle" src="{{$user->avatar}}"
                                                    alt="Profile Photo"/></div>
                                        <div class="text-center mbl">
                                            {!! Form::open(['method' => 'POST', 'route' => ['profile.update_image'] ,'enctype' => 'multipart/form-data' , 'class' => 'form-horizontal']) !!}
                                            {{ csrf_field() }}
                                            <label class="btn btn-green">
                                                @lang('module.change') <input type="file" onchange="this.form.submit()"
                                                                              name="avatar" hidden><i
                                                        class="fa fa-upload"></i>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </label>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td>@lang('module.profiles.name')</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('module.profiles.email')</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('module.profiles.status')</td>
                                            <td><span class="label label-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>@lang('module.profiles.code_forces_handle')</td>
                                            <td>
                                                <span class="label label-warning">{{$user->cf_handle or 'Not available'}}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('module.profiles.member_since')</td>
                                            <td>{{$user->created_at}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-9">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-edit" data-toggle="tab">@lang('module.edit') @lang('module.bars.sidebar_profile')</a>
                                        @if($user_status != null)
                                            <li><a href="#tab-messages" data-toggle="tab">CodeForces @lang('module.bars.sidebar_problems')</a></li>
                                        @endif
                                    </ul>
                                    <div id="generalTabContent" class="tab-content">
                                        <div id="tab-edit" class="tab-pane fade in active">
                                            {!! Form::open(['method' => 'POST', 'route' => ['profile.update'] ,'enctype' => 'multipart/form-data' , 'class' => 'form-horizontal']) !!}
                                            {{ csrf_field() }}
                                            <h3>@lang('module.profiles.account_settings')</h3>

                                            <div class="form-group"><label
                                                        class="col-sm-3 control-label">@lang('module.profiles.code_forces_handle')</label>
                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-9"><input type="text" name="cf_handle"
                                                                                     placeholder="{{$user->cf_handle or trans('module.placeholders.not-available')}}"
                                                                                     class="form-control"/></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group"><label
                                                        class="col-sm-3 control-label">@lang('module.profiles.old_password')</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-4"><input type="password" name="old"
                                                                                     id="password"
                                                                                     placeholder="@lang('module.placeholders.current-password')"
                                                                                     class="form-control"/></div>
                                                    </div>
                                                    @if ($errors->has('old'))
                                                        <span class="help-block"><strong>{{ $errors->first('old') }}</strong></span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="form-group"><label
                                                        class="col-sm-3 control-label">@lang('module.profiles.new_password')</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-4"><input type="password" id="password"
                                                                                     name="password"
                                                                                     placeholder="@lang('module.profiles.new_password')"
                                                                                     class="form-control"/></div>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group"><label
                                                        class="col-sm-3 control-label">@lang('module.profiles.confirm_new_password')</label>

                                                <div class="col-sm-9 controls">
                                                    <div class="row">
                                                        <div class="col-xs-4"><input type="password"
                                                                                     id="password"
                                                                                     name="password_confirmation"
                                                                                     placeholder="@lang('module.profiles.confirm_new_password')"
                                                                                     class="form-control"/></div>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr/>
                                            {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        @if($user_status != null)
                                            <div id="tab-messages" class="tab-pane fade in">
                                                @if($user_status->status != "FAILED")
                                                    <div class="list-group">
                                                        <div class="form-group"><p>Submissions
                                                                Count: {{$user_solved_count_problems = count($user_status->result)}}</p>
                                                        </div>
                                                        <table class="table table-hover" id="datatable">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>@lang('module.codeforces.problem-title')</th>
                                                                <th>@lang('module.codeforces.diff')</th>
                                                                <th>@lang('module.codeforces.status')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @for ($j = 0; $j < $user_solved_count_problems;$j++)
                                                                @if ($user_status->result[$j]->verdict == "OK")
                                                                    <tr>
                                                                        <td><a class="btn btn-link" href="http://codeforces.com/problemset/problem/{{$user_status->result[$j]->problem->contestId}}/{{$user_status->result[$j]->problem->index}}">{{$user_status->result[$j]->problem->contestId}}{{$user_status->result[$j]->problem->index}}</a></td>
                                                                        <td>
                                                                            <a class="btn btn-link" href="http://codeforces.com/problemset/problem/{{$user_status->result[$j]->problem->contestId}}/{{$user_status->result[$j]->problem->index}}">{{$user_status->result[$j]->problem->name}}</a>
                                                                        </td>
                                                                        <td>{{$user_status->result[$j]->problem->index}}</td>
                                                                        <td>
                                                                            <span class="label label-sm label-success">Approved</span>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endfor
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p>{{$user_status->comment}}</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--END CONTENT-->
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection