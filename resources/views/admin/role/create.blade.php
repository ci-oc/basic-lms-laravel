@extends('admin.layout.admin')
@section('content')
    <h3>@lang('module.create') @lang('administration.role')</h3>

    <form action="{{route('role.store')}}" method="post" role="form">
        {{csrf_field()}}

        <div class="form-group">
            <label for="name">@lang('administration.name_of_role')</label>
            <input type="text" class="form-control" name="name" id="" placeholder="@lang('administration.name_of_role')">
        </div>
        <div class="form-group">
            <label for="display_name">@lang('administration.display_name')</label>
            <input type="text" class="form-control" name="display_name" id="" placeholder="@lang('administration.display_name')">
        </div>
        <div class="form-group">
            <label for="description">@lang('administration.description')</label>
            <input type="text" class="form-control" name="description" id="" placeholder="@lang('administration.description')">
        </div>

        <div class="form-group text-left">
            <h3>@lang('administration.permissions')</h3>
            <div class="col-xs-12 form-group">
                <div class="col-sm-3">
                    <h3>@lang('module.roles.category_headers.security')</h3>
                    @foreach($security_permissions as $permission)
                        <input type="checkbox" class="1" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
                        <br>
                    @endforeach
                    <br><input type="checkbox"
                               onclick="checkAll(this , 1)"> @lang('module.select_all') @lang('module.roles.category_headers.security')
                </div>
                <div class="col-sm-3">
                    <h3>@lang('module.roles.category_headers.hep')</h3>
                    @foreach($hep_permissions as $permission)
                        <input type="checkbox" class="2" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
                        <br>
                    @endforeach
                    <br><input type="checkbox"
                               onclick="checkAll(this , 2)"> @lang('module.select_all') @lang('module.roles.category_headers.hep')
                </div>
                <div class="col-sm-3">
                    <h3>@lang('module.roles.category_headers.lep')</h3>
                    @foreach($lep_permissions as $permission)
                        <input type="checkbox" class="3" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
                        <br>
                    @endforeach
                    <br><input type="checkbox"
                               onclick="checkAll(this , 3)"> @lang('module.select_all') @lang('module.roles.category_headers.lep')
                </div>
                <div class="col-sm-3">
                    <h3>@lang('module.roles.category_headers.other')</h3>
                    @foreach($other_permissions as $permission)
                        <input type="checkbox" class="4" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}
                        <br>
                    @endforeach
                    <br><input type="checkbox"
                               onclick="checkAll(this , 4)"> @lang('module.select_all') @lang('module.roles.category_headers.other')
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection

<script src="{{asset('js/admin/select_all.js')}}"></script>
