@extends('layouts.sidebar')
@section('css')
    <link rel="stylesheet" href="{{asset('css/instructor/show_course_style.css')}}">
@endsection
@section('content')
    @if(Session::has('error_processing'))
        <div class="alert alert-danger">
            <p>{{Session::get('error_processing')}}</p>
        </div>
    @endif
    @if(Session::has('cannot_edit'))
        <div class="alert alert-danger">
            <p>{{Session::get('cannot_edit')}}</p>
        </div>
    @endif
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('module.placeholders.name')</th>
                                <th>@lang('module.created_at')</th>
                                <th>@lang('module.operations')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($material_relation as $file)
                                <tr>
                                    <td>{{$file['material_name']}}</td>
                                    <td>{{$file['created_at']}}</td>
                                    <td>
                                        <a href="download/{{$file['material_path']}}" class="btn-xs btn-link"><i class="fa fa-download" aria-hidden="true"></i> @lang('module.download')</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>
        </div>
        <?php $can_edit = false;?>
        @if(Auth::user()->can('edit-course'))
            @foreach($course->users as $user)
                @if($user->id == Auth::id())
                    <?php $can_edit = true;?>
                @endif
            @endforeach
            @if($can_edit)

                <div class="panel-footer">
                    <a href="{{ route('courses.edit',encrypt($course->id)) }}"
                       class="btn btn-info">@lang('module.edit')</a>
                </div>
            @endif
        @endif
    </div>
@endsection