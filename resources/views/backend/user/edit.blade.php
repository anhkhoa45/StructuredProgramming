@extends('backend.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        {!! trans('backend/user.mg_user') !!}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!! route('backend') !!}"><i class="fa fa-dashboard"></i> {!! trans('backend/base.home') !!}</a></li>
        <li><a href="{!! route('backend.setting.user.index') !!}">{!! trans('backend/user.user') !!}</a></li>
        <li><a href="{!! route('backend.setting.user.edit', $user->id) !!}">{!! trans('backend/user.edit_user') !!}</a></li>
    </ol>
</section>
<section class="content" id="user-wrap">
    <div class="row">
        @if(!is_null(Session::get('success')))
        <div class="col-xs-12">
            <div class='alert alert-success alert-dismissible'>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>{!! Session::get('success') !!}</h4>
            </div>
        </div>
        @endif
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h3 class="box-title">{!! trans('backend/user.edit_user') !!}</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{!! route('backend.setting.user.update', $user -> id) !!}" enctype= "multipart/form-data">
                        <input type="hidden" name="_method" value="PUT"/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="box-body">
                            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('backend/user.name') !!}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" value="{!! old('name') ?: $user->name !!}">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('backend/user.email') !!}</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" class="form-control" name="email" value="{!! old('email') ?: $user -> email !!}">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">{!! trans('backend/user.password') !!}</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="password" class="form-control" name="password" value="{!! old('password') !!}">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            @if ($user->id != $user::CAN_NOT_DELETE)
                            <div class="form-group {!! $errors->has('role_id') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label"><span class="required">*</span> {!! trans('backend/user.role_id') !!}</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2"name="role_id" style="width: 100%">
                                        @if (!is_null(old('role_id')))
                                        @foreach($roleArr as $key => $r)
                                        <option value="{!! $key !!}" {!! old('role_id') == $key ? 'selected="selected"' : '' !!}>{!! $r !!}</option>
                                        @endforeach
                                        @else 
                                        @foreach($roleArr as $key => $r)
                                        <option value="{!! $key !!}" {!! $user->role_id == $key ? 'selected="selected"' : '' !!}>{!! $r !!}</option>
                                        @endforeach
                                        @endif 
                                    </select>
                                    {!! $errors->first('role_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {!! $errors->has('active') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label"> {!! trans('backend/user.active') !!}</label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="active" {!! $user->active ? 'checked="checked"' : '' !!} />
                                    {!! $errors->first('active', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            @endif
                            <div class="form-group {!! $errors->has('avatar') ? 'has-error' : '' !!} " >
                                <label class="col-sm-2 control-label">{!! trans('backend/user.avatar') !!}</label>
                                <div class="col-sm-9">
                                    @if($user->avatar != '')
                                    <div class="image-preview-wrapper">
                                        <div class="image-preview-wrapper">
                                            <div class="image-preview" style="background-image: url('{!! $user->getAvatarUrl() !!}'); background-position:  center center; background-size: cover">
                                                <label for="image-input" class="image-label" style="display: none;">Change File</label>
                                                <input type="file" name="avatar" class="image-input">
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="image-preview-wrapper">
                                        <div class="image-preview">
                                            <label for="image-input" class="image-label">Choose File</label>
                                            <input type="file" name="avatar" class="image-input"/>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                {!! $errors->first('avatar', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit"class="btn btn-default pull-right custom-button">
                                <i class="fa fa-save"></i> {!! trans('backend/base.btn_save') !!}
                            </button>
                            <a href="{!! route('backend.setting.user.index') !!}" class="btn btn-default btn-default-hover">
                                <i class="fa fa-times"></i> {!! trans('backend/base.btn_cancel') !!}
                            </a>
                        </div>
                    </form>
                    <!-- /.form end -->
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col-xs-12 -->
</section>
<!-- /.section -->
@stop
@section('script')
@parent
<script src="{!! asset('js/nhn-user.js') !!}"></script>
@stop