@extends('layouts.sidebar')
@section('css')
    <link rel="stylesheet" href="{{asset('css/instructor/show_course_style.css')}}">
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $course->title }}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.course'):</h5>
                    {{$course->title}}
                    <hr>
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.access_code')
                        :</h5>
                    {{$course->access_code}}
                    <hr>
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.desc'):</h5>
                    {{$course->description}}
                    <hr>
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.created_at'):</h5>
                    {{$course->created_at}}
                    <hr>
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.assistant_professor_title')</h5>
                    <ul>
                        @foreach($assistant_professors as $professor)
                            <li style="font-weight: bold;">
                                <div class="chip">
                                    <img src="{{$professor->avatar}}" alt="ASSISTANT_PROFESSOR" width="96" height="96">
                                    {{ $professor->name }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.material'):</h5>
                    @if(count($material_relation) == 0)
                        <div class="alert alert-danger">
                            <p>@lang('module.errors.error-empty-material')</p>
                        </div>
                    @else
                        <table class="table table-inverse">
                            <thead>
                            <tr>
                                <th>@lang('module.courses.fields.file-name')</th>
                                <th>@lang('module.courses.fields.upload-date')</th>
                                <th>@lang('module.courses.fields.file-action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($material_relation as $file)
                                <tr>
                                    <td>{{$file['material_name']}}</td>
                                    <td>{{$file['created_at']}}</td>
                                    <td>
                                        <a href="download/{{$file['material_path']}}">@lang('module.courses.fields.file-download')</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                    @endif

                </div>
            </div>
        </div>
        @if(Auth::user()->can('edit-course'))
            <div class="panel-footer">
                <a href="{{ route('courses.edit',$course->id) }}"
                   class="btn btn-info">@lang('module.edit')</a>
            </div>
        @endif
    </div>
@endsection