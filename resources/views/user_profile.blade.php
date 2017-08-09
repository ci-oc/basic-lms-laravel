@extends('layouts.sidebar')
@section('content')
        <div class="col-lg-12">
            <div class="row">
                    <div class="row mtl">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="text-center mbl"><img
                                            src="{{Auth::user()->avatar}}" alt=""
                                            class="img-responsive img-circle"/></div>
                                <div class="text-center mbl"><a href="#" class="btn btn-green"><i
                                                class="fa fa-upload"></i>&nbsp;
                                        Upload</a></div>
                            </div>
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>User Name</td>
                                    <td>{{ ucfirst(Auth::user()->name) }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><span class="label label-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Member Since</td>
                                    <td>{{ ucfirst(Auth::user()->created_at) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-9">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-edit" data-toggle="tab">Edit
                                        Profile</a></li>
                            </ul>
                            <div id="generalTabContent" class="tab-content">
                                <div id="tab-edit" class="tab-pane fade in active">
                                    <h3 style="margin: auto;">Account Setting</h3>
                                    <hr>
                                    <form action="#" class="form-horizontal">

                                        <div class="form-group"><label class="col-sm-3 control-label">Email</label>

                                            <div class="col-sm-9 controls">
                                                <div class="row">
                                                    <div class="col-xs-9"><input type="email"
                                                                                 placeholder="{{ Auth::user()->email }}"
                                                                                 class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                    class="col-sm-3 control-label">Password</label>

                                            <div class="col-sm-9 controls">
                                                <div class="row">
                                                    <div class="col-xs-4"><input type="password"
                                                                                 placeholder="password"
                                                                                 class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-3 control-label">Confirm
                                                Password</label>

                                            <div class="col-sm-9 controls">
                                                <div class="row">
                                                    <div class="col-xs-4"><input type="password"
                                                                                 placeholder="password"
                                                                                 class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <button style="margin: auto;" type="submit" class="btn btn-primary">Finish
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
