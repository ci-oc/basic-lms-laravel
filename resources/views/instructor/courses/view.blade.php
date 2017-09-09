@extends('layouts.sidebar')
@section('content')
    <div class="panel panel-default">
        @foreach($courses as $course)
            @if($course->id == $id)
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
                                    <li style="font-weight: bold;">{{ $professor->name }}</li>
                                @endforeach
                            </ul>
                            <hr>
                            <h5 style="color: #3C3C3C; font-size: 20px;">@lang('module.courses.fields.material'):</h5>


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
                                    <td><a href="download/{{$file['material_path']}}">@lang('module.courses.fields.file-download')</a></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->isInstructor())
                    <div class="panel-footer">
                        <a href="{{ route('courses.edit',$id) }}"
                           class="btn btn-info">@lang('module.edit')</a>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endsection