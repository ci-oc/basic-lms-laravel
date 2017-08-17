@extends('admin.layout.admin')
@section('content')
    <h3>Roles</h3>
    <a class="btn btn-success" href="{{route('role.create')}}">Create Role</a>
    <br>
    <br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>
                    <div class="row"><!-- panel-footer -->
                        <div class="col-xs-3 text-left">
                                <a class="btn btn-info btn-sm" href="{{route('role.edit',$role->id)}}">Edit</a>
                        </div>
                        <div class="col-xs-4">
                                <form action="{{route('role.destroy',$role->id)}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                </form>
                        </div>
                    </div><!-- end panel-footer -->

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No roles found</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
