@extends('admin.layout.admin')
@section('content')
    @if(Session::has('success'))
        <div class="alert alert-info">
            <p>@lang('module.success.news-created')</p>
        </div>
    @endif
    @if(Session::has('success-deleting'))
        <div class="alert alert-info">
            <p>@lang('module.success.news-deleted')</p>
        </div>
    @endif
    {!! Form::open(['method' => 'POST', 'route' =>['news.store']]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.create')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('news',trans('module.news.news-text'),['class' => 'control-label']) !!}
                    {!! Form::textarea('news', old('news'), ['required','class' => 'form-control ','placeholder' => '', 'style' => 'resize:none;']) !!}
                    @if($errors->has('title'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('news') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::submit(trans('module.save'), ['class' => 'btn btn-danger' , 'onmouseover' => 'assign_date()']) !!}
    {{ Form::reset(trans('module.reset'), ['class' => 'btn btn-primary' ,'data-value' => 'shake']) }}
    {!! Form::close() !!}

    <hr>
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('module.news.current-news')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>News</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($all_news) > 0)
                            @foreach($all_news as $news)
                                <tr>
                                    <td>{{$news->news}}</td>
                                    <td>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $news->id]]) }}
                                        {{ Form::submit(trans('module.delete'), ['class' => 'btn-xs btn-danger']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">@lang('module.no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection