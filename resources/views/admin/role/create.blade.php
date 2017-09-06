@extends('admin.layout.admin')
@section('content')
    <h3>Create Roles</h3>

    <form action="{{route('role.store')}}" method="post" role="form">
        {{csrf_field()}}

    	<div class="form-group">
    		<label for="name">Name of role</label>
    		<input type="text" class="form-control" name="name" id="" placeholder="Name of role">
    	</div>
        <div class="form-group">
    		<label for="display_name">Display name</label>
    		<input type="text" class="form-control" name="display_name" id="" placeholder="Display name">
    	</div>
        <div class="form-group">
    		<label for="description">Description</label>
    		<input type="text" class="form-control" name="description" id="" placeholder="Description">
    	</div>

		{{--<select name="id" id="" multiple>--}}
			{{--<option value="1">men</option>--}}
			{{--<option value="2">men2</option>--}}
		{{--</select>--}}

        <div class="form-group text-left">
            <h3>Permissions</h3>
            <div class="col-xs-12 form-group">
                <div class="col-sm-4">
                    <h3>@lang('module.roles.category_headers.security')</h3>
                    @foreach($security_permissions as $permission)
                        <input type="checkbox"   name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                    @endforeach
                </div>
                <div class="col-sm-4">
                    <h3>@lang('module.roles.category_headers.hep')</h3>
                    @foreach($hep_permissions as $permission)
                        <input type="checkbox"   name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                    @endforeach
                </div>
                <div class="col-sm-4">
                    <h3>@lang('module.roles.category_headers.lep')</h3>
                    @foreach($lep_permissions as $permission)
                        <input type="checkbox"   name="permission[]" value="{{$permission->id}}" > {{$permission->name}} <br>
                    @endforeach
                </div>
            </div>







    	<button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

