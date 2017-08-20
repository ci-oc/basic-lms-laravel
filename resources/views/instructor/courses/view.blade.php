@extends('layouts.sidebar')
@section('content')
        <div class="row" style="margin-bottom:10px;">
            <div class="col-md-12">
                <div class="row">
                    @foreach($courses as $course)
                        @if($course->id == $id)
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                            <h3 class="page-title">@lang('module.courses.view-course')</h3>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ $course->title }}
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 form-group">
                                            <h3 style="color: #3C3C3C;">@lang('module.courses.fields.course'):</h3>
                                            {{$course->title}}
                                            <hr>
                                            <h3 style="color: #3C3C3C;">@lang('module.courses.fields.access_code'):</h3>
                                            {{$course->access_code}}
                                            <hr>
                                            <h3 style="color: #3C3C3C;">@lang('module.courses.fields.desc'):</h3>
                                            {{$course->description}}
                                            <hr>
                                            <h3 style="color: #3C3C3C;">@lang('module.courses.fields.created_at'):</h3>
                                            {{$course->created_at}}
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->isInstructor())
                                <div class="panel-footer">
                                    <a href="{{ route('courses.edit',$id) }}"
                                       class="btn btn-info">@lang('module.edit')</a>
                                </div>
                                @endif
                            </div>
                        @endif
                        @endforeach
                </div>
            </div>
        </div>
@endsection