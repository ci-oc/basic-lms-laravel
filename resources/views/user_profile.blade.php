<style type="text/css">
  [hidden] {
    display: none !important;
  }
</style>
@extends('layouts.sidebar')
@section('content')
<div class="col-lg-12">
  <div class="row">
    <div class="row mtl">
      <div class="col-md-3">
        <div class="form-group">
        {!! Form::open(['method' => 'POST' , 'route' => ['profile.store'] , 'enctype' => 'multipart/form-data' , 'class' => 'form-horizontal']) !!}                        
          <div class="text-center mbl">
            <img src="{{Auth::user()->avatar}}" alt="" class="img-responsive img-circle"/>
          </div>
          <div class="text-center mbl">
            <label class="btn btn-green">
              @lang('module.change') <input type="file" name="image" hidden>
            </label>    
          </div>
        </div>
        <br>
        <table class="table table-striped table-hover">
          <tbody>
            <tr>
              <td>@lang('module.profiles.user_name')</td>
              <td>{{ ucfirst(Auth::user()->name) }}</td>
            </tr>
            <tr>
              <td>@lang('module.profiles.email')</td>
              <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr>
              <td>@lang('module.profiles.status')</td>
              <td><span class="label label-success">@lang('module.profiles.active')</span></td>
            </tr>
            <tr>
              <td>@lang('module.profiles.member_since')</td>
              <td>{{ ucfirst(Auth::user()->created_at) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-9">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-edit" data-toggle="tab">@lang('module.profiles.edit_profile')</a></li>
        </ul>
        <div id="generalTabContent" class="tab-content">
          <div id="tab-edit" class="tab-pane fade in active">
            <h3 style="margin: auto;">@lang('module.profiles.account_setting')</h3>
            <hr>


            <div class="form-group"><label class="col-sm-3 control-label">@lang('module.profiles.email')</label>

              <div class="col-sm-9 controls">
                <div class="row">
                  <div class="col-xs-9"><input type="email"
                   placeholder="{{ Auth::user()->email }}"
                   class="form-control"/>
                 </div>
               </div>
             </div>
           </div>

           <div class="form-group"><label
            class="col-sm-3 control-label">@lang('module.profiles.password')</label>

            <div class="col-sm-9 controls">
              <div class="row">
                <div class="col-xs-4"><input type="password"
                 placeholder="password"
                 class="form-control"/>
               </div>
             </div>
           </div>
         </div>
         <div class="form-group"><label class="col-sm-3 control-label">@lang('module.profiles.confirm_password')</label>

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
       {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger']) !!}
       {!! Form::close() !!}
     </div>
   </div>
 </div>
</div>
</div>
</div>
</div>
@endsection
