@extends('layouts.sidebar')
@section('content')
    @if(Session::has('invalid_access_code'))
        <div class="alert alert-danger">
            <p>@lang('module.errors.error-access-code')</p>
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.courses.enroll-course')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped"
                   id="{{ count($available_courses) > 0 ? 'datatable' : '' }}">
                <thead>
                <tr>
                    <th>@lang('module.courses.relation-title')</th>
                    <th>@lang('module.users.registered-users')</th>
                    <th>@lang('module.users.instructors')</th>
                    <th>@lang('module.created_at')</th>
                    <th>@lang('module.operations')</th>
                </tr>
                </thead>

                <tbody>
                @if( count($available_courses ) > 0)
                    @foreach($available_courses as $course)
                        <tr data-entry-id="{{ $course->id }}">
                            <td>{{ $course->title }}</td>
                            <td>{{ count($course->users) }}</td>
                            <td>
                                @foreach($course->users as $user)
                                    {{$user->name}}
                                    <br>
                                @endforeach
                            </td>
                            <td>{!! $course->created_at !!}</td>
                            <td>
                                <button class="btn btn-xs btn-danger" id="enroll{{$course->id}}"
                                        onclick="enroll({{$course->id}})"><i class="fa fa-plus-circle" aria-hidden="true"></i> @lang('module.courses.enroll-course')</button>
                                <div class="form-group" id="register{{$course->id}}" style="display:none;">
                                    {{ Form::open(['method' => 'POST', 'route' => 'enroll.store']) }}
                                    {{ Form::hidden('course_id', encrypt($course->id), array('id' => 'course_id')) }}
                                    {!! Form::input('text','access_code', old('access_code'), ['class' => 'form-control','required', 'placeholder' => trans('module.courses.fields.access_code')]) !!}
                                    {{ Form::submit(trans('module.save'), ['class' => 'btn-xs btn btn-info']) }}
                                    {!! Form::close() !!}
                                </div>
                                <a href="{{ route('courses.show',[encrypt($course->id)]) }}"
                                   class="btn btn-xs btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> @lang('module.view')</a>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">@lang('module.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        function enroll(id) {
            $("#register" + id).toggle(200);
        }
    </script>
@endsection