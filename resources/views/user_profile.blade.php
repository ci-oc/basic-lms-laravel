@extends('layouts.sidebar')
@section('content')
    <div class="row mbl">
        <div class="col-lg-12">

            <div class="col-md-12">
                <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                </div>
            </div>

        </div>

        <div class="col-lg-12">


            <div class="row">
                <div class="col-md-12"><h2>Profile: John Doe</h2>

                    <div class="row mtl">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="text-center mbl"><img
                                            src="http://lorempixel.com/640/480/business/1/" alt=""
                                            class="img-responsive"/></div>
                                <div class="text-center mbl"><a href="#" class="btn btn-green"><i
                                                class="fa fa-upload"></i>&nbsp;
                                        Upload</a></div>
                            </div>
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>User Name</td>
                                    <td>John Doe</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>name@example.com</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>Street 123, Avenue 45, Country</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><span class="label label-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Member Since</td>
                                    <td> Jun 03, 2014</td>
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
                                                                                 placeholder="email@yourcompany.com"
                                                                                 class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label
                                                    class="col-sm-3 control-label">Username</label>

                                            <div class="col-sm-9 controls">
                                                <div class="row">
                                                    <div class="col-xs-9"><input type="text"
                                                                                 placeholder="username"
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


    </div>
@endsection
