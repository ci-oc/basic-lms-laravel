@extends('admin.layout.admin')
@section('content')
    <h3>@lang('administration.bars.sidebar_users')</h3>

    <table class="table table-striped table-bordered" id="datatable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Roles</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>
                    @foreach($user->roles as $role)
                        {{$role->name}}
                    @endforeach
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#myModal-{{$user->id}}">
                        @lang('module.edit')
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal-{{$user->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">{{$user->name}} @lang('module.edit')</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('user.update',$user->id)}}" method="post" role="form"
                                          id="role-form-{{$user->id}}">
                                        {{csrf_field()}}
                                        {{method_field('PATCH')}}
                                        <div class="form-group">

                                            <select name="roles[]" multiple class="selectpicker">
                                                @foreach($allRoles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"
                                            onclick="$('#role-form-{{$user->id}}').submit()">@lang('module.save')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <td colspan="3">No users found</td>
        @endforelse
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

